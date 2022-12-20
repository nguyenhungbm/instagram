<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $month_now = Carbon::now()->month;
        $new_admin = Admin::whereMonth('created_at', $month_now)->count();
        $new_user = User::whereMonth('created_at', $month_now)->count();
        $new_post = Post::join('users', 'posts.p_user', 'users.id')
            ->where('p_type', 'profile')->count();
        $viewData = [
            'new_admin' => $new_admin,
            'new_user' => $new_user,
            'new_post' => $new_post,
            'title' => 'Trang quản trị',
        ];
        return view('admin.index', $viewData);
    }

    public function user()
    {
        return view('admin.user.index', [
            'title' => 'Người dùng',
        ]);
    }

    public function post()
    {
        return view('admin.post.index', [
            'title' => 'Bài viết',
        ]);
    }
}
