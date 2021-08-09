<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Auth;
use App\Http\Requests\RequestLogin;
use Mail;
use App\Mail\RegisterSuccess;
use App\Models\User;

class LoginController extends Controller 
{
    public function showLoginForm(){
        return view('auth.login');
    }
    public function login(RequestLogin $request){
        $data =$request->only('email','password');
        if(Auth::attempt($data) || Auth::attempt(['user'=> $request->email , 'password' => $request->password]) ||
        Auth::attempt(['phone'=> $request->email , 'password' => $request->password])
        ){ 
            if(Auth::user()->is_active ==1){
                return redirect()->to('/');
            }
            else if(Auth::user()->is_active ==0){
                Auth::logout();
                \Session::flash('toastr',[
                    'type'=>'error',
                    'messages'=>'Tài khoản của bạn chưa được xác thực . Chúng tôi đã gửi một email đến '.$request->email.' với một liên kết để xác thực tài khoản của bạn.'
                ]);
                Mail::to($request->email)->send(new RegisterSuccess($request->c_name,$request->user));
                return redirect()->route('login');
            }
            else if(Auth::user()->is_active ==2){
                Auth::logout();
                \Session::flash('toastr',[
                    'type'=>'error',
                    'messages'=>'Tài khoản của bạn đã bị khóa do vi phạm chính sách của chúng tôi! '
                ]);
                return redirect()->route('login');
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
    public function loginByToken($token){
        $user = User::where('remember_token',$token)->first();
        $login = Auth::loginUsingId($user->id, true);
        if($login)
            return 1;
        else 
            return 0; 
    }
    protected function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
