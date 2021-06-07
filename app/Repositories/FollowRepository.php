<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Follow;
use Auth;
use Carbon\Carbon;
class FollowRepository
{
    public function follow($request){
        $data=$request->all();
        $data['user_id']=Auth::user()->id;
        $data['created_at']=Carbon::now('Asia/Ho_Chi_Minh'); 
        $isFollow =Follow::where(['user_id'=>Auth::user()->id,'followed'=>$data['followed']])->count();
        if($isFollow){
            Follow::where(['user_id'=>Auth::user()->id,'followed'=>$data['followed']])->delete();
            User::where('id',$data['followed'])->decrement('follower');
            return response([
                'action'            => 'bot',
                'user'              => User::find($data['followed']),
                'auth'              => Auth::user(),
                'followed'          => Follow::where('user_id',Auth::id())->count(), 
                'text_follow'       => ucwords(__('translate.follow')),
                'user_follow'       => ucwords(__('translate.followers')),
                'see_user_follow'   => __("translate.You'll see all the people who follow you here.")
                ]);
        }
        else{
            $id=Follow::insertGetId($data); 
            User::where('id',$data['followed'])->increment('follower');
            return response([
                'action'            => 'them',
                'user'              => User::find($data['followed']),
                'auth'              => Auth::user(),
                'avatar'            => pare_url_file(Auth::user()->avatar,'user'),
                'followed'          => Follow::where('user_id',Auth::id())->count(),
                'text_follow'       => ucwords(__('translate.folowing')),
                'see_user_follow'   => __('translate.Message'),
            ]);
        } 
    }
}