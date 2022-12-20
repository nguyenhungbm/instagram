<?php

namespace App\Services;

use App\Models\Follow;
use App\Models\User;
use Auth;
use Carbon\Carbon;

class UserService
{
    public function follow($data)
    {
        $data['user_id'] = Auth::user()->id;
        $data['created_at'] = Carbon::now();
        $isFollow = Follow::where(['user_id' => Auth::user()->id, 'followed' => $data['followed']])->count();
        if ($isFollow) {
            Follow::where(['user_id' => Auth::user()->id, 'followed' => $data['followed']])->delete();
            User::where('id', $data['followed'])->decrement('follower');
            return response([
                'action' => 'bot',
                'user' => User::find($data['followed']),
                'auth' => Auth::user(),
                'followed' => Follow::where('user_id', Auth::id())->count(),
                'text_follow' => ucwords(__('translate.follow')),
                'user_follow' => ucwords(__('translate.followers')),
                'see_user_follow' => __("translate.You'll see all the people who follow you here.")
            ]);
        } else {
            $id = Follow::insertGetId($data);
            User::where('id', $data['followed'])->increment('follower');
            return response([
                'action' => 'them',
                'user' => User::find($data['followed']),
                'auth' => Auth::user(),
                'avatar' => pare_url_file(Auth::user()->avatar, 'user'),
                'followed' => Follow::where('user_id', Auth::id())->count(),
                'text_follow' => ucwords(__('translate.folowing')),
                'see_user_follow' => __('translate.Message'),
            ]);
        }
    }

    public function uploadAvatar($request)
    {
        $user = User::find(Auth::user()->id);
        // if($user->avatar != 'no-user.png'){
        //     unlink(public_path('uploads/user/'.$user->avatar));
        // }
        // if($user->avatar != 'ninja.jpg'){
        //     unlink(public_path('uploads/user/'.$user->avatar));
        // }
        if ($request->hasFile('upload_user_avatar')) {
            $image = upload_image('upload_user_avatar', 'user');
            if ($image['code'] == 1) {
                $user->avatar = $image['name'];
            }
        }
        if ($user->update()) {
            return User::find(Auth::user()->id);
        } else {
            return 700;
        }
    }

    public function deleteAvatar()
    {
        $user = User::find(Auth::user()->id);
        // if($user->avatar != 'ninja.jpg'){
        //     unlink(public_path('uploads/user/'.$user->avatar));
        // }
        // if($user->avatar != 'no-user.png'){
        //     unlink(public_path('uploads/user/'.$user->avatar));
        // }
        $user->avatar = 'no-user.png';
        if ($user->update()) {
            echo 200;
        } else {
            echo 700;
        }
    }
}

?>