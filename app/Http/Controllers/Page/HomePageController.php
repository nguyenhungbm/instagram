<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Repositories\HomePageRepository;
class HomePageController extends Controller
{ 
    public $homePageRepository;
    public function __construct(HomePageRepository $homePageRepository){
        $this->homePageRepository = $homePageRepository;
    }
    public function index($id){ 
        return $this->homePageRepository->get($id);
    } 
}
