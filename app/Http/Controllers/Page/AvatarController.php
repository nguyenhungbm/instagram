<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use App\Repositories\AvatarRepository;
class AvatarController extends Controller
{   
    public $avatarRepository;
    public function __construct(AvatarRepository $avatarRepository){
        $this->avatarRepository = $avatarRepository;
    }
    public function uploadAvatar(Request $request){
        return $this->avatarRepository->upload($request);
    }

    public function deleteAvatar(){ 
        return $this->avatarRepository->delete();
    } 
}
