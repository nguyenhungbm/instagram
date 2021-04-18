<?php

namespace App\Http\Controllers\Personal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExploreController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){ 
        $viewData=[ 
            'title'=>'Khám phá'
        ];
        return view('explore',$viewData);
    }
}
