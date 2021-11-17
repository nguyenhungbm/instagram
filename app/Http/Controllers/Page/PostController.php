<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
class PostController extends Controller
{  
    public function savePost(Request $request){  
        $postService = app()->make('PostService');
        return $postService->create($request->except('_token','profiles','stories'),$request);
    }
    
    public function increView(Request $request){
        Post::where('id',$request->post)->increment('p_view');
        return Post::find($request->post);
    }

   
}
