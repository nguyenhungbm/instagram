<?php

namespace App\Http\Controllers\Activate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use App\Notifications\CommentPost;
class PostImage extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function CommentPost(Request $request){  
        $data=$request->except('_token');
        $data['created_at']=Carbon::now();
        $data['updated_at']=Carbon::now(); 
        $id=Comment::InsertGetId($data);
        $post=Post::find($data['c_post']);
        $user=User::find(\Auth::id());

        if($data['c_user_id'] != $post->user->id)
        User::find($post->user->id)->notify(new CommentPost($post,$user,'comment'));
        return response([
            'count'=> Post::find($data['c_post']),
            'user'=>\Auth::user(), 
            'avatar' =>pare_url_file(\Auth::user()->avatar,'user')
            ]);
    }

    public function LikePost(Request $request){
        $data = $request->all();
        $count= Like::where(['r_post'=>$data['r_post'],'r_user_id'=>\Auth::user()->id ])->first();  
        if($count){  
            $count->delete();
            Post::where('id',$data['r_post'])->decrement('p_favourite'); 
            return response([
                'action'=>'bot',
                'post'=> Post::find($data['r_post']),
                'user'=>\Auth::user(), 
                'avatar' =>pare_url_file(\Auth::user()->avatar,'user')
                ]);
        } 
        $data['r_user_id']=\Auth::user()->id;
        $data['created_at']=Carbon::now();
        $data['updated_at']=Carbon::now();
        $post=Post::find($data['r_post']);
        $user=User::find(\Auth::id());
        
        if($data['r_user_id'] != $post->user->id)
        User::find($post->user->id)->notify(new CommentPost($post,$user,'like'));

        $id=Like::InsertGetId($data);
        Post::where('id',$data['r_post'])->increment('p_favourite');
        return response([
            'action'=>'them',
            'word' =>__('translate.likes'),
            'post'=> Post::find($data['r_post']),
            'user'=>\Auth::user(), 
            'avatar' =>pare_url_file(\Auth::user()->avatar,'user')
            ]);
    }
}
