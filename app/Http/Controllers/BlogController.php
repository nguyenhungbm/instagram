<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Post; 
use Validator;
use Redirect;
use Response;
use Image;
class BlogController extends Controller
{
    public function getArticles(Request $request)
    {
        $img = Image::make('https://scontent.fhph1-1.fna.fbcdn.net/v/t1.6435-0/p526x296/174713723_4224318754265637_1191518664109034512_n.jpg?_nc_cat=111&ccb=1-3&_nc_sid=730e14&_nc_ohc=duNGBIQvxnUAX9_hcYp&_nc_ht=scontent.fhph1-1.fna&tp=6&oh=099e828ff85beaec1ee0d9a5b9e678cc&oe=60A915C7')->resize(300, 200);
 
        $img->save('ba1r.jpg',60);
    }    
}