<?php

namespace App\Http\Controllers\Account;

use App\Billing\{
    PaymentFailedException, PaymentGateway
};
use App\Http\Controllers\Controller;
use App\Models\Finance\Order;
use App\Models\Training\School\AutoSchool;
use App\Models\User\Coupon;
use App\Models\User\UserSchool;
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
            $school = UserSchool::where('user_id', $user->id)->first();
            if (!empty($school)) {
                $order = Order::create([
                    'payment_option' => 'online',
                    'amount' => $charge->amount(),
                    'number_contract' => $user->contract->name . $user->id . '-' . $user->contract->id . '-' . $user->city->id,
                    'user_id' => $user->id,
                    'auto_school_id' => $school->school_id
                ]);
                $director = AutoSchool::find($school->school_id)->director_id;
                $this->notification($user->id, "Вы оплатил учёбу в автошколе! Номер оплаты $order->id");
                $this->notification($director, "Пользователь $user->name $user->last_name оплатил учёбу в автошколе!");
            } else {
                $order = Order::create([
                    'payment_option' => 'online',
                    'amount' => $charge->amount(),
                    'number_contract' => $user->contract->name . $user->id . '-' . $user->contract->id . '-' . $user->city->id,
                    'user_id' => $user->id,
                    'auto_school_id' => 0
                ]);
            }

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