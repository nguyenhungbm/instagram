<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\Admin;
class AdminController extends Controller
{
    
    use AuthenticatesUsers;
        
    public function getLoginAdmin(){
        return view ('admin.auth.login');
    }
    public function postLoginAdmin(Request $request)
	{
		if(\Auth::guard('admins')->attempt(['email' => $request->email, 'password' => $request->password])) {

			return redirect()->route('admin.index');
		}
		
		return redirect()->back();
	}

	public function getRegisterAdmin(){
        return view ('admin.auth.register');
    }
    public function postRegisterAdmin(Request $request)
	{
		$request->validate([
			'name' =>'required',
            'email'=>'email|required|unique:admins,email',
            'password' =>'min:6',
        ],[
            'name.required'=>'Bạn cần nhập tên quản trị viên',
            'email.unique'=>'Email đã được đăng ký',
            'email.required'=>'Bạn cần nhập email',
            'email.email'=>'Email không đúng định dạng',
            'password.min'=>'Mật khẩu cần ít nhất 6 kí tự',
        ]);
		$data= $request->except('_token');
		$data['password']=Hash::make($data['password']);
        $data['created_at']=Carbon::now();
        $id =Admin::InsertGetId($data);
		\Auth::guard('admins')->attempt(['email' => $request->email, 'password' => $request->password]);
		return redirect()->route('admin.index');
		
	}
	public function getLogoutAdmin()
	{
		\Auth::guard('admins')->logout();
		return redirect()->route('get.login.admin');
	}
    
}
