<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Account\NotificationController;
use App\Models\User\Contract;
use App\Models\User\Notification;
use App\Models\User\User;
use App\Models\Location\Region;
use App\Notifications\UserRegistration;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Psy\Exception\ErrorException;

/**
 * Class RegistrationController
 * @package App\Http\Controllers\Site
 */
class RegistrationController extends Controller
{
    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function registration(Request $request, Notification $notification)
    {
        $validator = Validator::make($request->all(), [
            'name'        => 'required|string|min:3',
            'last_name'   => 'required|string|min:3',
            'second_name' => 'string|min:3',
            'email'       => 'required|email|unique:users,email',
            'phone'       => 'required',
            'password'    => 'required|string|min:6',
            'city_id' 		  => 'required|exists:cities,id',
            'license' => 'required|in:A,B,C'
        ]);

        if (count($validator->errors())) {
            return response()->json(['registerErrors' => $validator->errors(), 'status' => 0], 400);
        }

        try {
            $data = $request->only([
                'name',
                'last_name',
                'second_name',
                'email',
                'phone',
                'password',
                'city_id',
                'license'
            ]);

            $data['role']              = 'user';
            $data['confirmation_code'] = str_random(30);
            $user                      = User::create($data);
            $full_name                 = $user->name . ' ' . $user->last_name;

            $contract = Contract::create([
                'name' => $this->generateContractNumber($user),
                'user_id' => $user->id
            ]);

            Controller::notification($user->id,'Вы поступили в Школу Автотренер! 
Мы скоро свяжемся с Вами и согласуем детали обучения.');
            Auth::loginUsingId($user->id);

            //$user->notify(new UserRegistration($full_name, $user->confirmation_code));


            return response()->json(['status' => 1], 201);
        } catch (ErrorException $e) {
            return response(['status' => 0], 400);
        }
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email|exists:users,email',
            'password' => 'required|string|min:6',
        ]);

        if (count($validator)) {
            return response()->json(['status' => 0], 400);
        }

        $credentials = $request->only(['email', 'password']);

    }

    private function generateContractNumber($user){
        $firstDay = date_create($user->created_at)
            ->modify('first day of this month')
            ->format('Y-m-d');
        $lastDay = date_create($user->created_at)
            ->modify('last day of this month')
            ->format('Y-m-d');
        $userQuantity = User::where('created_at', '>=', $firstDay)
            ->where('created_at', '<=', $lastDay)->count();
        $userNumber = str_pad($userQuantity, 4, "0", STR_PAD_LEFT);
        return "K" . $user->license . "-" . date("m") . date("y") . "-" . $userNumber;
    }
}
