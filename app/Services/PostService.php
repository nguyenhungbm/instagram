<?php
namespace App\Services;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Carbon\Carbon;
use Image;
use Auth;
use Str;
use App\Notifications\CommentPost;
class PostService{
    public function create($data){
        $data['created_at'] = Carbon::now();
        $data['p_user']     = Auth::id(); 
        $data['p_slug']     = Str::random(15);
        if($request->profiles){
            $data['p_type'] = 'profile';
            $file = $request->file('profiles');
            $filename = $file->getClientOriginalName();
            $img = Image::make($file);
            $img->text('NGUYEN HUNG', 30, 30, function($font) { 
                $font->file(public_path('FontDacingScript.ttf'));
                $font->size(10); 
                $font->color('#000'); 
            });          
    
            $img->resize(600, 600)->save(public_path('uploads/profile/img/'.$filename));
            $img->resize(650, 650)->save(public_path('uploads/profile/img_large/'.$filename));
            $img->resize(296, 296)->save(public_path('uploads/profile/img_small/'.$filename));
    
            $data['p_image'] = $filename;  

            DB::table('users')->where('id',Auth::user()->id)->increment('picture');
        }
        if($request->stories){
            $image = upload_image('stories','story');
            if($image['code']==1)
                $data['p_image']=$image['name'];
            $data['p_type']='story';
            DB::table('users')->where('id',Auth::user()->id)->increment('story');
        }
        $id=Post::insertGetId($data);
        return redirect()->back();
    }
    public function like($data){
        $count= Like::where(['r_post'=>$data['r_post'],'r_user_id'=> Auth::user()->id ])->first();  
        if($count){  
            $count->delete();
            Post::where('id',$data['r_post'])->decrement('p_favourite'); 
            return response([
                'action'=>'bot',
                'post'=> Post::find($data['r_post']),
                'user'=> Auth::user(), 
                'avatar' =>pare_url_file( Auth::user()->avatar,'user')
                ]);
        } 
        $data['r_user_id']= Auth::user()->id;
        $data['created_at']=Carbon::now();
        $data['updated_at']=Carbon::now();
        $post=Post::find($data['r_post']);
        $user=User::find( Auth::id());
        
        if($data['r_user_id'] != $post->user->id)
        User::find($post->user->id)->notify(new CommentPost($post,$user,'like'));

        $id=Like::InsertGetId($data);
        Post::where('id',$data['r_post'])->increment('p_favourite');
        return response([
            'action'=>'them',
            'word' =>__('translate.likes'),
            'post'=> Post::find($data['r_post']),
            'user'=> Auth::user(), 
            'avatar' =>pare_url_file( Auth::user()->avatar,'user')
            ]);
    }
    public function comment($data){
        $data['c_user_id']  =  Auth::id();
        $data['created_at'] = Carbon::now();
        $data['updated_at'] = Carbon::now(); 
        Comment::InsertGetId($data);
        $post = Post::find($data['c_post']);
        $user = User::find( Auth::id());

        if($data['c_user_id'] != $post->p_user)
        User::find($post->p_user)->notify(new CommentPost($post,$user,'comment'));
        return response([
            'user'   =>  Auth::user(), 
            'avatar' => pare_url_file( Auth::user()->avatar,'user')
            ]);
    }
}

?>