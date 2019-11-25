<?php

namespace App\Http\Requests;

class LoginRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'account'=>'required',
            'password'=>'required',
            'captcha'=>'required|captcha'
        ];
    }

    public function messages() {
        return [
            'account.required'=>'请填写账号',
            'password.required'=>'请填写密码',
            'captcha.required'=>'请填写验证码',
            'captcha.captcha'=>'验证码失败'
        ];
    }
}
