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
        $msgs=array(
            0=>'Пароль успешно изменен',
            1=> 'Пароль слишком короткий',
            2 => 'Старый пароль неверный',
            3=> 'Новый пароль и подтверждение не совпадают'

        );

        $validator = Validator::make($request->all(), [
            'old_password' => 'required|min:6',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|min:6',
        ]);
        $old_password = $request->old_password;
        $new_password = $request->new_password;
        $confirm_password = $request->confirm_password;
        $user = Auth::user();
        $status=0;
        if($validator->fails())
            $status=1;
        else if(! Hash::check($old_password, $user->password))
              $status=2;
            else if($new_password!=$confirm_password)
                $status=3;
       if($status == 0){
            $user->password = $new_password;
            $user->save();
        }

        return response()->json(['msg' => $msgs[$status] ]);
    }
    public function setNotices(Request $request)
    {
        $email_notice = (string) $request->email_notice;
        $sms_notice = (string)$request->sms_notice;
        $id= Auth::id();
        DB::table('users')
            ->where('id', $id)
            ->update(['email_notice' => $email_notice,'sms_notice' => $sms_notice]);
        return response()->json(['msg' => 'Изменения успешно сохранены' ]);
    }


}
