<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $post=Post::join('users','posts.p_user','users.id')
                    ->select('posts.*','users.user','users.c_name')
                    ->where('p_type','profile')->paginate(15);
         
        $viewData=[
            'post'  => $post,
            'title' =>'Bài viết',
        ];
        return view('admin.post.index',$viewData);
    }
    public function delete($id)
    {
        $post=Post::find($id);
        if($post) $post->delete();
        return redirect()->back();
    }
}
