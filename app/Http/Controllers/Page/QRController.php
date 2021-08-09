<?php

namespace App\Http\Controllers\Page;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Str;
class QRController extends Controller
{ 
    public function create($slug)
    { 
        $post = Post::where('p_slug',$slug)->first();
        if($post->p_qrcode != ""){
            $img = $post->p_qrcode;
        }
        else{
            $img = $slug.'.svg';
            $post->p_qrcode = $img;
            $post->save();
        
            $link = url('/p/'.$slug);
            $qr = QrCode::generate($link, '../public/uploads/qrcode/' . $img);
        }
        return response([
            'img'  => pare_url_file( $img ,'qrcode'),
        ]);
    }
    public function login()
    { 
        $img = Str::random(10).'.svg';
        $link = \Auth::user()->remember_token;
        $qr = QrCode::generate($link, '../public/uploads/qrcode/' . $img);
        return response([
            'img'  => pare_url_file( $img ,'qrcode'),
        ]);
    }
}
