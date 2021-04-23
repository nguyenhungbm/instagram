<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Post; 
use Validator;
use Redirect;
use Response;

class BlogController extends Controller
{
    public function getArticles(Request $request)
    {
        $results = Post::orderBy('id')->paginate(10);
        $artilces = '';
        if ($request->ajax()) {
            foreach ($results as $result) {
                $artilces.='<div class="card mb-2"> <div class="card-body">'.$result->id.' <h5 class="card-title">'.$result->post_name.'</h5> '.$result->post_description.'</div></div>';
            }
            return $artilces;
        }
        return view('welcomes');
    }    
}