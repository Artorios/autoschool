<?php

namespace App\Http\Controllers\Account;

use App\Models\Location\City;
use App\Models\User\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
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
            'phone'       => 'required',
            'city_id'     => 'required',
            'license'     => 'required'
        ]);

        if (count($validator->errors())) {
            return response()->json(['status' => 0], 400);
        }
        $validator = Validator::make($itempost, [
            'email' => 'unique:users,email,'.$itempost['id']
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

    public function editNotifySettings(Request $request){
        User::where(['id' => $request->input('id')])->update(['email_notice' => $request->input('email_notice')]);
        User::where(['id' => $request->input('id')])->update(['sms_notice' => $request->input('sms_notice')]);
        return response()->json(['status' => 1], 204);

    }

    public function saveProfileImage(Request $request)
    {
        $user = Auth::user();

        if ($request->hasFile('img')){
            $file = $request->file('img');

            $validator = Validator::make($request->all(), [
                'img'     => 'required|mimes:jpeg,bmp,png',
            ]);

            if (count($validator->errors())) {
                return response()->json(['errors' => $validator->errors()], 400);
            }

            try {
                $file_name = sha1_file($file) . $file->getCTime() . '.' . $file->getClientOriginalExtension();
                Storage::putFileAs('public/user', $file, $file_name);
                if($user->image && 'public/user/' . $user->image){
                   //delete photo
                    Storage::delete('public/user/' . $user->image);
//                    unlink('public/user' . $user->image);
                }
                $user->update(['image' => $file_name]);
                return response()->json(['status' => 1], 201);
            } catch (ErrorException $e) {
                return response()->json(['status' => 0], 402);
            }
            return response()->json(['status' => 6], 200);
        }








//        return response()->json(['status' => 0], 200);
    }
}
