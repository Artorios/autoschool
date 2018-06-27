<?php

namespace App\Http\Controllers\Autoschool;

use App\Models\User\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function notifyRead(Request $request, Notification $notification){
        $itempost = $request->input();
        if($notification->where(['id' => $itempost])->update(['status' => 0])){
            return response()->json(['status' => 1], 204);
        }
        return response()->json(['status' => 0], 400);
    }
    public function getPageAll(Notification $notification){

        $user_id = Auth::user()->id;
        $this->data['notifies'] = $notification->where(['user_id'=> $user_id])->orderBy('date', 'desc')->orderBy('time', 'desc')->paginate(10);
        return view('autoschool.notify.all', $this->data);
    }

    public function getPageNew(Notification $notification){
        $user_id = Auth::user()->id;
        $this->data['notifies'] = $notification->where(['user_id'=> $user_id, 'status' => 1])->orderBy('date', 'desc')->orderBy('time', 'desc')->paginate(10);
        return view('autoschool.notify.index', $this->data);
    }


}
