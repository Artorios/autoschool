<?php

namespace App\Http\Controllers\Account;

use App\Billing\{
    PaymentFailedException, PaymentGateway
};
use App\Http\Controllers\Controller;
use App\Models\Finance\Order;
use App\Models\User\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{
    Auth, Validator
};


class OrderController extends Controller
{
    private $paymentGateway;

    public function __construct(PaymentGateway $paymentGateway)
    {
        $this->paymentGateway = $paymentGateway;
    }

    public function cardPayment(Request $request)
    {

        $user = auth()->user();

        $validator = Validator::make($request->all(), [
            'numberCard' => 'required',
            'validityMonth' => 'required',
            'validityYear' => 'required',
            'cvv2Code' => 'required',
        ]);

        if (count($validator->errors())) {
            return response()->json(['status' => 0, $validator->errors()], 400);
        }

        try {

            $charge = $this->paymentGateway->charge($request->input('amount'), $this->paymentGateway->getValidTestToken());

            $order = Order::create([
                'payment_option' => 'online',
                'amount' => $charge->amount(),
                'number_contract' => 125468,
                'user_id' => $user->id
            ]);

            return response()->json($order, 201);

        } catch (PaymentFailedException $e) {
            return response()->json([], 422);
        }
    }

    public function cuponPayment(Request $request)
    {
        $cupon = Coupon::where('code', $request->input('number_cupon'))->get()->first();
        if (!$cupon) {
            return response()->json(['status' => 0], 400);
        }

        if ($cupon->status == 2 && $cupon->code == $request->input('number_cupon')) {
            $cupon->update([
                'status' => 3,
                'student_id' => Auth::user()->id
            ]);
            return response()->json(['status' => 1], 201);
        } else {
            return response()->json(['status' => 0], 400);
        }

    }
}