<?php

namespace App\Http\Controllers;

use App\Models\User\Notification;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

/**
 * Class Controller
 * @package App\Http\Controllers
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function notification($user_id, $notify){
        if(!empty($user_id && $notify)){
            $notification = new Notification;
            $time = date("H:i:s");
            $date = date("Y-m-j");
            $notification->insert(['user_id' => $user_id, 'notify' => $notify, 'time' => $time, 'date' => $date, 'status' => 0]);
        }
    }
}
