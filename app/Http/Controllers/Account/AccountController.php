<?php

namespace App\Http\Controllers\Account;

use App\Models\Location\City;
use App\Models\User\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
/**
 * Class AccountController
 * @package App\Http\Controllers\Account
 */
class AccountController extends Controller
{

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function updateProfile(Request $request, User $user, City $city){
        $itempost = $request->input();
        $validator = Validator::make($itempost, [
            'name'        => 'required|string|min:3',
            'last_name'   => 'required|string|min:3',
            'second_name' => 'string|min:3',
            'phone'       => 'required',
            'city_id'     => 'required',
            'license'     => 'required'
        ]);

        if (count($validator->errors())) {
            return response()->json(['status' => 0], 400);
        }
        $validator = Validator::make($itempost, [
            'email'       => 'required|email|unique:users,email'
        ]);
        if (count($validator->errors())) {
            return response()->json(['status' => 5], 400);
        }
        $user->where(['id' => $itempost['id']])->update($itempost);
        return response()->json(['status' => 1], 201);

    }
    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function updatePassword(Request $request, User $user){
        $password = $request->input('password');
        $newPassword = $request->input('new_password');
        $newPassword = bcrypt($newPassword);
        $userNow = Auth::user();
        $oldPassword = $user->select('password')->where(['id' => $userNow['id']])->firstOrFail();

        if(Hash::check($password, $oldPassword['password'])){
            $user->where(['id' => $userNow['id']])->update(['password' => $newPassword]);
            return response()->json(['status' => 1], 205);
        }
        else{
            return response()->json(['status' => 0, 'password' => $password], 400);

        }
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function editNotifySettings(Request $request, User $user){
        $itempost = $request->input();
        if(isset($itempost['notify_email']) or isset($itempost['notify_phone'])){
            if(isset($itempost['notify_email'])){
                $user->where(['id' => $itempost['id']])->update(['notify_email' => $itempost['notify_email']]);
            }
            if(isset($itempost['notify_phone'])){
                $user->where(['id' => $itempost['id']])->update(['notify_phone' => $itempost['notify_phone']]);
            }

            return response()->json(['status' => 1], 204);
        }

        return response()->json(['status' => 0], 400);

    }
}
