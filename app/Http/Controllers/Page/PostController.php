<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Repositories\Post\PostRepositoryInterface;
class PostController extends Controller
{ 
    public $postRepository;
    public function __construct(PostRepositoryInterface $postRepository){
        $this->postRepository = $postRepository;
    }
    public function index()
    {
        $products = $this->postRepository->getPost();

        return $products;
    }

    public function savePost(Request $request){   
        return $this->postRepository->create($request);
    }
    
    public function increView(Request $request){
        Post::where('id',$request->post)->increment('p_view');
        return Post::find($request->post);
    }
}
