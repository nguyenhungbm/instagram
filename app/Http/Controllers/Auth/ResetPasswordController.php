<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Http\Requests\RequestLogin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordSuccess;
class ResetPasswordController extends Controller
{
   public function getFormPassword(){
       return view('auth.forgot-password');
   }
   public function postPassword(RequestLogin $request){  
       $user =User::where('email',$request->email)->first();
    \Session::flash('toastr',[
        'type'=>'success',
        'messages'=>'Chúng tôi đã gửi một email đến '.$request->email.' với một liên kết để truy cập lại vào tài khoản của bạn.'
    ]);
    Mail::to($request->email)->send(new ResetPasswordSuccess($user->c_name,$user->user));

    return redirect()->back();
}

    public function changePassword(Request $request){
        $user =User::where('user',$request->user)->first(); 
        return view('account.change_password',compact('user'));
    }
    public function StorePassword(Request $request){
        $user =User::where('user',$request->user)->first();  
        $request->validate([
            'password'=>'min:6',
            're_password' =>"required|same:password"
        ],[
            'password.min'=>'Mật khẩu cần nhiều hơn 6 kí tự',
            're_password.required'=>'Mật khẩu xác nhận không đúng',
            're_password.same'=>'Mật khẩu xác nhận không đúng',

        ]);
            $data['password']=Hash::make($request->password);
            $user->update($data);
            \Session::flash('toastr',[
                'type'=>'success',
                'messages'=>'Đổi mật khẩu thành công'
            ]);
            \Auth::loginUsingId($user->id, true);
            return redirect()->to('/');
    }
}
