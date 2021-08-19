<?php

namespace App\Http\Controllers\Activate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\User;
class NotificationController extends Controller
{
    public function index()
    {
        $notification =\Auth::user()->unreadNotifications;
        $notification_readed =\Auth::user()->readNotifications;
        $data=[
            'notification'=>$notification,
            'notification_readed'=>$notification_readed,
        ];
       return $data;
    }
    public function read(Request $request)
    {   
       \Auth::user()->unreadNotifications()->find($request->id)->MarkAsRead();
       return 'success';
    }
    
}
