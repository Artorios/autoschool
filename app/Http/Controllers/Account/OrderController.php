<?php

namespace App\Http\Controllers\Account;

use App\Billing\{
    PaymentFailedException, PaymentGateway
};
use App\Http\Controllers\Controller;
use App\Models\Finance\{
    Order, Coupon
};
use App\Models\Training\School\AutoSchool;
use App\Models\User\{
    UserSchool, User
};
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{
    Auth, Validator, DB
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
        $cupon = Coupon::where('code', $request->get('number_cupon'))->first();
        if (!$cupon) {
            return response()->json(['status' => 0], 400);
        }

        if ($cupon->status == 2 && $cupon->code == $request->input('number_cupon')) {
            $director = AutoSchool::find($cupon->auto_school_id)->director_id;
            $user = Auth::user();
            DB::transaction(function () use ($cupon, $user, $request) {
                Coupon::where('code', $request->get('number_cupon'))->update([
                    'student_id' => $user->id,
                    'activated_at' => Carbon::now(),
                    'status' => 3,
                ]);
                if (!empty($cupon->auto_school_group_id)) {
                    User::where('id', $user->id)->update([
                        'auto_school_group_id' => $cupon->auto_school_group_id
                    ]);
                }
            });
            $this->notification($user->id, "Вы активировали купон! Номер купона $cupon->id");
            $this->notification($director, "Пользователь $user->name $user->last_name активировал купон $cupon->code!");

            return response()->json(['status' => 1], 201);
        } else {
            return response()->json(['status' => 0], 400);
        }

    }
}