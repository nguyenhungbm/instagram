<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RequestLogin;
class LoginController extends Controller 
{
    public function getFormLogin(){
        return view('auth.login');
    }
    public function postLogin(RequestLogin $request){
        $data =$request->only('email','password');
        if(Auth::attempt($data)){ 
            if(Auth::user()->is_active ==1){
                 
                return redirect()->to('/');
            }
            else if(Auth::user()->is_active ==0){
                Auth::logout();
                \Session::flash('toastr',[
                    'type'=>'error',
                    'messages'=>'Tài khoản chưa được xác thực . Vui lòng kiểm tra lại gmail !'
                ]);
                return redirect()->route('get.login');
            }
            else if(Auth::user()->is_active ==2){
                Auth::logout();
                \Session::flash('toastr',[
                    'type'=>'error',
                    'messages'=>'Tài khoản của bạn đã bị khóa do vi phạm chính sách của chúng tôi! '
                ]);
                return redirect()->route('get.login');
            }
}
        else{
            \Session::flash('toastr',[
                'type'=>'error',
                'messages'=>'Sai tài khoản hoặc mật khẩu'
            ]);
        }
        return redirect()->back();
    }
    protected function getLogout(){
        Auth::logout();
        return redirect()->route('get.login');
    }
}
