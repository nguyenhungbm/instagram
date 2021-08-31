<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Post;
use App\Models\Follow;
use Illuminate\Http\Request;

class HomePageController extends Controller
{ 
    public function index($id,Request $request){
        //$id là username có thể là Auth->user hoặc không  
        $user = User::where('user',$id)->first();  
        $post = Post::where(['p_user'=>$user->id ,
        'p_type'=>'profile'
       ])
        ->orderBy('created_at','desc')
        ->simplePaginate(12);  

        $countPost = Post::where(['p_user'=>$user['id'],'p_type'=>'profile'])->count();                   
        $video = Post::where(['p_user'=>$user['id'],
                           'p_type'=>'video'])
                    ->orderBy('created_at','desc')
                    ->get();
        
        //số người đang theo dõi
        $areFollow =Follow::where(['user_id'=>$user['id']])->orderBy('created_at','desc')->get();
        //kiểm tra xem có theo dõi người khác hay không
        $isFollow =Follow::where(['user_id'=>\Auth::id(),'followed'=>$user['id']])->count();
        //đang theo dõi ai
        $userFollow =Follow::where('followed',$user['id'])->orderBy('created_at','desc')->get();
        $output = '';
        if ($request->ajax()) {
                foreach ($post as $key =>$val) {
                    $output.= view('layout.homepage.post',compact('key','val','user'))->render();
                }   
            return $output;
        }
        $viewData =[
            'user'       => $user,
            'countPost'  => $countPost, 
            'title'      => '',
            'post'       => $post, 
            'video'      => $video, 
            'followed'   => $isFollow,
            'areFollow'  => $areFollow,
            'userFollow' => $userFollow
        ];  
        return view('home-page',$viewData);
    }
}
