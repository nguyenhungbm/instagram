<?php

namespace App\Repositories;
use App\Models\User; 
use Auth;
class AvatarRepository
{
    public function upload($request){
        $user =  User::find(Auth::user()->id);   
        if($user->avatar != 'no-user.png'){
            unlink(public_path('uploads/user/'.$user->avatar));
        }
        if ($request->hasFile('upload_user_avatar')) {
        $image =upload_image('upload_user_avatar','user');
        if($image['code']==1)
            $user->avatar=$image['name'];
        }
        if($user->update()){
        return  User::find(Auth::user()->id);
        }else{
            return 700;
        }
    }

    public function delete(){ 
        $user =  User::find(Auth::user()->id); 
        if($user->avatar != 'no-user.png'){
            unlink(public_path('uploads/user/'.$user->avatar));
        }
        $user->avatar='no-user.png';  
        if($user->update()){
            echo 200;
        }else{
            echo 700;
        }
    } 
}