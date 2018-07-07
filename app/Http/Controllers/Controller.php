<?php

namespace App\Http\Controllers;

use App\Models\User\Notification;
use App\Models\User\User;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Mail;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Mail\Notification as NotifyMail;

/**
 * Class Controller
 * @package App\Http\Controllers
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function notification($user_id, $notify)
    {
        if (!empty($user_id && $notify)) {
            $notification = new Notification;
            $time = date("H:i:s");
            $date = date("Y-m-j");
            $user = User::where('id', $user_id)->first();
            $notification->insert(['user_id' => $user_id, 'notify' => $notify, 'time' => $time, 'date' => $date, 'status' => 1]);
            if($user->email_notice == 1){
                $mailData['name'] =  $user->last_name.' '.$user->name;
                $mailData['email'] =  strval($user->email);
                $mailData['notify'] =  $notify;
                Mail::to(strval($user->email))->send(new NotifyMail($mailData));
            }

        }
    }
}
