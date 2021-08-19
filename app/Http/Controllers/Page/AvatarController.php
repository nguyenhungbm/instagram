<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use App\Repositories\AvatarRepository;
class AvatarController extends Controller
{    
    public function __construct(){ 
    }
    public function upload(Request $request){
        $userService = app()->make('UserService');
        return $userService->uploadAvatar($request);
    }

    public function delete(){ 
        $userService = app()->make('UserService');
        return $userService->deleteAvatar();
    } 
}
