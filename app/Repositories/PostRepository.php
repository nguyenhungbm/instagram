<?php

namespace App\Repositories;

use App\Models\Post;
use Auth;
use DB;
use Image;
use Carbon\Carbon;
use Str;
class PostRepository
{
    public function create($request){
        $data=$request->except('_token','profiles','stories');  
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
}