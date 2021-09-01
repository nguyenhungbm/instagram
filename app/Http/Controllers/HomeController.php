<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use App\Models\Follow; 
use App\Models\Post;
use App\Models\Address;
use DB;
use Carbon\Carbon;
class HomeController extends Controller
{ 
    public function index(Request $request)
    {      
        //tất cả bài viết của những người bạn theo dõi
        $posts =Post::join('follows','follows.followed','posts.p_user')
                    ->where('follows.user_id',\Auth::id())
                    ->where('posts.p_type','profile')
                    ->select('posts.*')
                    ->orderBy('created_at','desc')
                    ->simplePaginate(5);  

        $count_post =Post::join('follows','follows.followed','posts.p_user')
            ->where('follows.user_id',\Auth::id())
            ->where('posts.p_type','profile')
            ->count();

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
    
    $output = '';
    if ($request->ajax()) {
            foreach ($posts as $key =>$val) {
                $output.= view('layout.homes.post',compact('key','val'))->render();
            }   
        return $output;
    }
        $data=[
            'posts' => $posts, 
            'count_post' => $count_post, 
            'user'  => $user,     
            'title' => 'Instagram'
        ];
        return view('welcome',$data);
    }
    public function search(Request $request){
        // full text search 
        // $val = User::where('id','!=',\Auth::id())
        //             ->search($request->value)
        //             ->get();

        $val =  User::where('id','!=',\Auth::id())
                ->where('user','like','%'.$request->value.'%')
                ->orwhere('c_name','like','%'.$request->value.'%')
                ->get();
        if(!$val->isEmpty())
            return view('layout.header.data',compact('val'))->render();
        else{
            return 0;
        }
    }
    public function data(){
        for($i=2;$i<100;$i++){
        $data['user_id']=$i ;
        $data['created_at']=Carbon::now(); 
        $data['followed'] = \Auth::user()->id;
        $id=Follow::insertGetId($data); 
        }
        for($j=2;$j<100;$j++){
            $val['user_id']=  \Auth::user()->id;
            $val['created_at']=Carbon::now(); 
            $val['followed'] =$j;
            $id=Follow::insertGetId($val); 
            }
        return 'success';
    }
    public function getAddress(){
        $login = Address::where('user',\Auth::id())->get();
        return $login;
    }
    public function storeAddress(Request $request){
        $current_location =  Address::where(['user' =>\Auth::id(),
        'address'  => $request->name 
       ])->first();
        if($current_location){
            $current_location->updated_at = Carbon::now();
            $current_location->save() ;
            return 1;
        }else{
            $data['user'] = \Auth::id();
            $data['lat']  = $request->lat;
            $data['lng']  = $request->lng;
            $data['address']  = $request->name;
            $data['created_at'] = Carbon::now();
            $data['updated_at'] = Carbon::now();
            $id= Address::insertGetId($data);
            return $id;
        }
    }
}
