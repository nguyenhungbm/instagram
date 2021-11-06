<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestLogin extends FormRequest
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
            'email'=>'required',
            'password'=>'required',
            'g-recaptcha-response' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'email.required'=>'Bạn chưa điền tên đăng nhập',
            'password.required'=>'Bạn chưa điền mật khẩu',
            // 'g-recaptcha-response.required'=>'Bạn cần xác minh không phải là robot'
        ];
    }
}
