<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Pusher\Pusher;
use App\Models\User; 
use App\Models\Follow; 
use App\Models\Comment;
use App\Models\Post;
use App\Models\Like;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;  
class HomeController extends Controller
{
     
    public function __construct()
    {
        $this->middleware('auth');
    }

     
    public function index(Request $request)
    {    
        if(Gate::allows('is-admin')){
            return view('admin.index');
        }
        //tất cả bài viết của những người bạn theo dõi
        $posts =Post::join('follows','follows.followed','posts.p_user')
                    ->where('follows.user_id',\Auth::id())
                    ->where('posts.p_type','profile')
                    ->select('posts.*')
                    ->get(); 
        $now =Carbon::now();
        
        $areFollow =Follow::where(['user_id'=>\Auth::id()])->get();
        $user=[];
        if(!count($areFollow)){
            $user =User::where('id','!=',\Auth::id())
            ->orderBy('picture','desc')
            ->limit(5)
            ->get(); 
} 
        else{
        foreach($areFollow as $list){
        $user =User::where('id','!=',$list->id)
                    ->where('id','!=',\Auth::id())
                    ->orderBy('picture','desc')
                    ->inRandomOrder()
                    ->limit(5)
                    ->get(); 
        } 
    }
        $data=[
            'now'   => $now,
            'posts' => $posts, 
            'user'  => $user,     
            'title' => 'Instagram'
        ];
        return view('welcome',$data);
    }
     
}
