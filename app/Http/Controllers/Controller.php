<?php

namespace App\Http\Controllers;

use App\Models\User\Notification;
use App\Models\User\User;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Mail\Mailer;
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
            $notification->insert(['user_id' => $user_id, 'notify' => $notify, 'time' => $time, 'date' => $date, 'status' => 1]);
            $mailer = Mailer::class;
            $user = User::where('id', $user_id)->first();
            if($user->email_notice == 1){
                $mailData['name'] =  $user->last_name.' '.$user->name;
                $mailData['email'] =  $user->email;
                $mailData['notify'] =  $notify;
                $mailer->to($user->email)->send(new NotifyMail($user));
            }

        }
    }
}
