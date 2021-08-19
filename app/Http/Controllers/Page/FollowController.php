<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class FollowController extends Controller
{ 
    public function follow(Request $request){
        $userService = app()->make('UserService');
        return $userService->follow($request->all());
    }
}
