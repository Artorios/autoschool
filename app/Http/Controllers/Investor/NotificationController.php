<?php

namespace App\Http\Controllers\Investor;

use Illuminate\Http\Request;
use App\Models\User\Notification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function all(Request $request)
    {
        $data = Notification::where('user_id', Auth::user()->id)->orderBy('date', 'desc')->orderBy('time', 'desc');


        return view('investor.notifications.all', [
            'notifications' => $data->paginate(10),
        ]);
    }
    public function index(){
        $data = Notification::where('user_id', Auth::user()->id)->where('status', 1)->orderBy('date', 'desc')->orderBy('time', 'desc');

        return view('investor.notifications.index', [
            'notifications' => $data->paginate(10),
        ]);

    }

    public function update(Notification $notification)
    {
        $this->authorize('read-notification', $notification);

        $notification->update([
            'status' => 0,
        ]);

        return response()->json([
            'messages' => ['Уведомление прочитано'],
            'data' => true,
        ], 204);
    }
}
