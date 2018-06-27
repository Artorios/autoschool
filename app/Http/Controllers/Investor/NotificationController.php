<?php

namespace App\Http\Controllers\Investor;

use Illuminate\Http\Request;
use App\Models\User\Notification;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $data = Notification::where('user_id', $request->user()->id)->orderBy('date', 'desc')->orderBy('time', 'desc');

        if ($request->get('show') == 'new') {
            $data = $data->where('status', 1);
        }

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
