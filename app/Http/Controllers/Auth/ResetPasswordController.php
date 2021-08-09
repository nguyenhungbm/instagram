<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Auth;
use App\Http\Requests\RequestLogin;
use Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Mail;
use App\Mail\ResetPasswordSuccess;
use App\Mail\RegisterSuccess;
class ResetPasswordController extends Controller
{
    public function reset(Request $request){   
        $validatedData = $request->validate(
            ['email' => 'required'],
            ['email.required' => 'Bạn cần chọn email']
        );
        $user =User::where('email',$request->email)->first();
        if($user){
            if($user->is_active  == 0){
                \Session::flash('toastr',[
                    'type'=>'success',
                    'messages'=>'Tài khoản của bạn chưa được xác thực . Chúng tôi đã gửi một email đến '.$request->email.' với một liên kết để xác thực tài khoản của bạn.'
                ]);
            }else if($user->is_active == 2){
                \Session::flash('toastr',[
                    'type'=>'error',
                    'messages'=>'Tài khoản của bạn đã bị khóa'
                ]);
            }else{
                \Session::flash('toastr',[
                    'type'=>'success',
                    'messages'=>'Chúng tôi đã gửi một email đến '.$request->email.' với một liên kết để yêu cầu thay đổi mật khẩu với tài khoản của bạn.'
                ]);
                Mail::to($request->email)->send(new ResetPasswordSuccess($user->c_name,$user->user));
            }
        }
        else {
            \Session::flash('toastr',[
                'type'=>'error',
                'messages'=>'Tài khoản của bạn chưa được đăng ký'
            ]);
        }
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
