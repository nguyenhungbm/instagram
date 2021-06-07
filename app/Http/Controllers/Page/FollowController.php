<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\FollowRepository;

class FollowController extends Controller
{ 
    public $followRepository;
    public function __construct(FollowRepository $followRepository){
        $this->followRepository = $followRepository;
    }
    public function follow(Request $request){
       return $this->followRepository->follow($request);
    }
}
