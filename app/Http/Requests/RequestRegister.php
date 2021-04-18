<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestRegister extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'=>'required|unique:users',
            'c_name'=>'required',
            'user'=>'required|unique:users',
            'password'=>'min:6'
        ];
    }
    public function messages()
    {
        return [
            'email.required'=>'Bạn chưa điền tên đăng nhập', 
            'email.unique'  =>"Tài khoản đã được đăng ký", 
            'user.required'=>'Bạn chưa điền tên người dùng',
            'user.unique'   =>'Tên người dùng đã được đăng ký',
            'c_name.required'=>'Bạn chưa nhập tên đầy đủ',
            'password.min'=>'Mật khẩu cần nhiều hơn 6 ký tự'
        ];
    }
}
