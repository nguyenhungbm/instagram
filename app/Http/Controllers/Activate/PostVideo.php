<?php

namespace App\Http\Controllers\Activate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Video;
class PostVideo extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function UploadVideo(){
        $viewData=[
            'title'=>'Upload a Video'
        ] ;
        return view('upload.video',$viewData);
    }
    public function StoreVideo(Request $request){ 
        $data=$request->except('_token','file');
        $data['v_user']=\Auth::user()->id;
        if($request->file('file')){
        $video =upload_image('file','video');
        if($video['code']==1)
          $data['v_video']=$video['name'];
        }
        $data['created_at']=Carbon::now();
        $data['updated_at']=Carbon::now();
        $id=Video::insertGetId($data);
        return redirect()->to('/'.\Auth::user()->user);
    }

}
