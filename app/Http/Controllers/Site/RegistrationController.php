<?php

namespace App\Http\Controllers\Site;

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
    public function registration(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'        => 'required|string|min:3',
            'last_name'   => 'required|string|min:3',
            'second_name' => 'nullable|string|min:3',
            'email'       => 'required|email|unique:users,email',
            'phone'       => 'required',
            'password'    => 'required|string|min:6',
			'city' 		  => 'required|exists:cities,id',
			'license_category' => 'required|in:A,B,C'
        ]);

		$validator->validate();

        try {
            $data = $request->only([
                'name',
                'last_name',
                'second_name',
                'email',
                'phone',
                'password',
				'license_category'
            ]);

            $data['role']              = 'user';
            $data['confirmation_code'] = str_random(30);
            $user                      = User::create($data);
            $full_name                 = $user->name . ' ' . $user->last_name;

            $user->notify(new UserRegistration($full_name, $user->confirmation_code));

            Auth::loginUsingId($user->id);

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
}
