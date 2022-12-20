<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function view_post(Request $request, $slug)
    {
        $post = Post::where('p_slug', $slug)->first();
        $related_post = Post::where('id', '!=', $post->id)
            ->where('p_user', $post->p_user)
            ->orderby('id', 'desc')->limit(6)->get();
        $viewData = [
            'val' => $post,
            'related_post' => $related_post,
            'title' => '',
        ];
        return view('view_post', $viewData);
    }

    public function delete(Request $request, $slug)
    {
        $post = Post::where('p_slug', $slug)->first();
        if ($post) {
            $post->delete();
        }
        return redirect()->back();
    }
}
