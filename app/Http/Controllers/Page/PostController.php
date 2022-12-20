<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function savePost(Request $request)
    {
        $postService = app()->make('PostService');
        return $postService->create($request->except('_token', 'profiles', 'stories'), $request);
    }

    public function increView(Request $request)
    {
        Post::where('id', $request->post)->increment('p_view');
        return Post::find($request->post);
    }


}
