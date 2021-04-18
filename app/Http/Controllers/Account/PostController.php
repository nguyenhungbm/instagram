<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Carbon\Carbon;
class PostController extends Controller
{
    public function view_post(Request $request,$slug){ 
        $post=Post::where('p_slug',$slug)->first();
        $related_post=Post::where('id','!=',$post->id)
                           ->where('p_user',$post->p_user)
        ->orderby('id','desc')->limit(6)->get();
        $viewData=[
            'val' =>$post,
            'related_post' =>$related_post,
            'title'=>'',
            'now'  => Carbon::now(),

        ];
        return view('view_post',$viewData);
    }
}
