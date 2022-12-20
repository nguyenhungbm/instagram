<?php

namespace App\Http\Controllers\Activate;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notification = Auth::user()->unreadNotifications;
        $notification_readed = Auth::user()->readNotifications;
        $data = [
            'notification' => $notification,
            'notification_readed' => $notification_readed,
        ];
        return $data;
    }

    public function read(Request $request)
    {
        Auth::user()->unreadNotifications()->find($request->id)->MarkAsRead();
        return 'success';
    }

}
