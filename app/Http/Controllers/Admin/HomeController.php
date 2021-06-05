<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;
use App\Models\Post;
use Carbon\Carbon;
class HomeController extends Controller
{
    public function index(){
        $month_now = Carbon::now()->month;
        $new_admin=Admin::whereMonth('created_at',$month_now)->count();
        $new_user=User::whereMonth('created_at',$month_now)->count();
        $new_post=Post::join('users','posts.p_user','users.id')
        ->where('p_type','profile')->count();
        $viewData=[
            'new_admin'=>$new_admin,
            'new_user'=>$new_user,
            'new_post'=>$new_post,
            'title' =>'Trang quản trị',
        ];
        return view('admin.index',$viewData);
    }
    public function list(){
        $user=User::orderBy('id','desc')->paginate(15);
        $title='Người dùng';
        return view('admin.user.list',compact('user','title'));
    }
    public function block_user($id)
    {
        $user=User::find($id);
        if($user->is_active==1) $user->is_active=2;
        else if($user->is_active==2)
        $user->is_active=1;
        $user->save();
        return redirect()->back();
    }
    public function delete($id)
    {
        $user=User::find($id);
        $user->delete();
        return redirect()->back();
    }
}
