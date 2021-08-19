<?php

namespace App\Http\Controllers\Activate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostImage extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function CommentPost(Request $request){  
        $postService = app()->make('PostService');
        return $postService->comment($request->all());
    }

    public function LikePost(Request $request){
        $postService = app()->make('PostService');
        return $postService->like($request->all());
    }
}
