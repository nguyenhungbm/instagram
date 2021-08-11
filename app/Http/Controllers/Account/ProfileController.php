<?php
namespace App\Http\Controllers\Account;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class ProfileController extends Controller
{  
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function edit(){
        $data=[
            'title' =>'Edit Profile'
        ];
        return view('account.profile',$data);
    }
    public function store(Request $request){
        $user = User::find(\Auth::id());
        if($request->ajax()){ 
            $user->gender=$request->gender;
            $user->updated_at =Carbon::now();
            $user->save();
            if($user->gender==1){
                return __('translate.Male');
            }
            if($user->gender==2){
                return __('translate.Female');
            }
            if($user->gender==3){
                return __('translate.Custom');
            }
            if($user->gender==4){
                return __('translate.Prefer Not To Say');
            }
        }
        $data=$request->except('_token','gender');
        $data['updated_at']=Carbon::now();
        $user->update($data);
        return redirect()->back();
    }
    public function password(){
        $data=[
            'title' =>'Change Password'
        ];
        return view('account.password',$data);
    }
    public function store_password(Request $request){
        if(strlen($request->password)<6){
            \Session::flash('toastr',[
            'type'=>'error',
            'messages'=>__('translate.Your password needs to be at least 6 characters.')
            ]);
            return redirect()->back();
        }
        if($request->password == $request->oldpassword){
            \Session::flash('toastr',[
            'type'=>'error',
            'messages'=>__("translate.New password can't match old password.")
            ]);
            return redirect()->back();
        }
        if($request->re_password != $request->password){
            \Session::flash('toastr',[
            'type'=>'error',
            'messages'=>__('translate.Please make sure both passwords match.')
            ]);
            return redirect()->back();
        }
        if(!Hash::check($request->oldpassword,\Auth::user()->password)){
            \Session::flash('toastr',[
            'type'=>'error',
            'messages'=>__('translate.Your old password was entered incorrectly. Please enter it again.')
            ]);
            return redirect()->back();
        }
        $user =\Auth::user();
        $user->password = Hash::make($request->password);
        $user->save();
        $data=[
        'title' =>'Change Password'
        ];
        \Session::flash('toastr',[
        'type'=>'success',
        'messages'=>__('translate.Change password success !')
        ]);
        return redirect()->back();
    }
    public function ConfirmPhone(Request $request){
        return view('account.confirm_phone',$request->phone) ;
    }
}