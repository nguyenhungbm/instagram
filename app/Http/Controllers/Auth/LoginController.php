<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Auth;
use App\Http\Requests\RequestLogin;
use Mail;
use App\Mail\RegisterSuccess;
use App\Models\User;
use Illuminate\Http\Request; 

class LoginController extends Controller 
{
    public function showLoginForm(){
        if(Auth::user())
            return redirect()->route('home');
        return view('auth.login');
    }
    public function login(RequestLogin $request){
        $data =$request->only('email','password');
        $user = User::where('email',$request->email)->first();
        if(Auth::attempt($data) || Auth::attempt(['user'=> $request->email , 'password' => $request->password]) ||
        Auth::attempt(['phone'=> $request->email , 'password' => $request->password])
        ){ 
        if(Auth::user()->is_active ==1){
                return redirect()->to('/');
               return response()->json([
                    'status' => '300',
                    'message' => '',
               ]);
            }
            else if(Auth::user()->is_active ==0){
                Auth::logout();
                Mail::to($request->email)->send(new RegisterSuccess($request->c_name,$user->user));
                return response()->json([
                    'status' => '400',
                    'message' => 'Tài khoản của bạn chưa được xác thực . Chúng tôi đã gửi một email đến '.$request->email.' với một liên kết để xác thực tài khoản của bạn.',
               ]);
            }
            else if(Auth::user()->is_active ==2){
                Auth::logout();
               //  return redirect()->route('login');
                return response()->json([
                    'status' => '200',
                    'message' => 'Tài khoản của bạn đã bị khóa do vi phạm chính sách của chúng tôi!',
               ]);
            }
    }
        else{
          return response()->json([
               'status' => '200',
               'message' => 'Sai tài khoản hoặc mật khẩu',
          ]);
        }
    }
    public function loginByToken(Request $request){
        $user = User::where('remember_token',$request->token)->first();
        if($user)
       {
        $login = Auth::loginUsingId($user->id, true);
        if($login)
            return 1;
        else 
            return 0;
        }
         else 
           return 0; 
    }
    protected function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
