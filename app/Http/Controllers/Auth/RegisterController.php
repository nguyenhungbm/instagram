<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Auth;
use Hash;
use Validator;
use Carbon\Carbon;
use App\Models\Follow; 
use App\Http\Requests\RequestRegister;
use Mail;
use App\Mail\RegisterSuccess;
use Illuminate\Http\Request;
use App\SendCode;
use Str;
class RegisterController extends Controller
{ 
    public function showRegistrationForm(){ 
        if(Auth::user())
            return redirect()->route('home');
            return view('auth.register');
    }
    public function register(RequestRegister $request)
    { 
        $data =$request->except('_token');  
        $data['avatar']     = 'no-user.png';
        $data['password']   = Hash::make($data['password']);
        $data['created_at'] = Carbon::now(); 
        $data['is_active'] = 1; 
        $data['remember_token'] = Str::random(10);
        if(is_numeric($request->email)){
            $request->validate([
                'email'=>'min:8|max:12'
            ],[
                'email.min'  => 'Số điện thoại nhiều hơn 8 số',
                'email.max'  => 'Số điện thoại không được quá 12 số'
            ]);
            $data['phone']      = $data['email'];
            $data['code_otp']   = SendCode::SendCode($data['email']); 
            User::insertGetId($data);
            \Session::flash('toastr',[
                'type'=>'success',
                'messages'=>'Đăng ký thành công . Vui lòng nhập mã xác minh !'
            ]);
            return redirect()->route('user.verify.message');
        }
       
        else{
            $request->validate([
                'email'=>'email'
            ],[
                'email.email'=>'Email không đúng định dạng'
            ]);
            $id =User::insertGetId($data);
            \Session::flash('toastr',[
                'type'=>'success',
                'messages'=>'Đăng ký thành công . Vui lòng xác nhận tài khoản qua gmail !'
            ]);
            // Mail::to($request->email)->send(new RegisterSuccess($request->c_name,$request->user));

           return redirect()->route('login');
        } 
        
        return redirect()->back();
    }

    public function getVerifyAccount($user){
        $user =User::where('user',$user)->first();
        $user->is_active =1;
        $user->save();
       
        $user->save();
        Auth::loginUsingId($user->id, true);
        \Session::flash('toastr',[
            'type'=>'success',
            'messages'=>'Xác minh tài khoản thành công !'
        ]);
        return redirect()->to('/');
    }
    public function getVerifyMessage(){
        return view('layout.verify_phone');
    }
    public function postVerifyMessage(Request $request){
        $code=$request->a.$request->b.$request->c.$request->d.$request->e.$request->f;   
        $user =User::where('code_otp',$code)->first();
        if($user){
        Auth::loginUsingId($user->id, true);
            $user->is_active=1;
            $user->code_otp=0;
            $user->save();
            \Session::flash('toastr',[
                'type'=>'success',
                'messages'=>'Xác minh tài khoản thành công !'
            ]);
        return redirect()->to('/');
        }else{
            \Session::flash('toastr',[
            'type'=>'error',
            'messages'=>'Mã xác thực không đúng !'
        ]);
        return redirect()->back();

        }
    }
}