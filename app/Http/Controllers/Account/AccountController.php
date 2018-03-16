<?php

namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
/**
 * Class AccountController
 * @package App\Http\Controllers\Account
 */
class AccountController extends Controller
{

    public function profile(){
        $uinfo = DB::table('users')
            ->where('id',Auth::id() )
            ->first();

        return view('account.profile',['uinfo'=>$uinfo]);

    }
    public function changePassword(Request $request){

        $status='ok';
        $validator = Validator::make($request->all(), [
            'old_password' => 'required|min:6',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|min:6',
        ]);
        $old_password = $request->old_password;
        $new_password = $request->new_password;
        $confirm_password = $request->confirm_password;
        $user = Auth::user();

        if($validator->fails() ||! Hash::check($old_password, $user->password) || $new_password!=$confirm_password ){
            $status='error';
        }else{
            $user->password = Hash::make($new_password);
            $user->save();
        }

        return response()->json(['status' => $status ]);
    }


}
