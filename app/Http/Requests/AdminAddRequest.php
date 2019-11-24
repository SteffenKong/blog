<?php

namespace App\Http\Requests;

/**
 * Class AdminRequest
 * @package App\Http\Requests
 */
class AdminAddRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'account' => 'required|unique:admin',
            'password' => 'required',
            'email' => 'required|email|unique:admin',
            'phone' => 'required|unique:admin',
            'status' => 'in:0,1'
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
       return [
           'account.required' => '请填写账号',
           'account.unique' => '账号已存在',
           'password.required' => '请填写密码',
           'email.required' => '请填写邮箱',
           'email.unique' => '邮箱已存在',
           'email.email' => '邮箱格式不正确',
           'phone.required' => '请填写手机号码',
           'phone.unique' => '手机号码已存在',
           'status.in' => '状态值取值异常'
       ];
    }
}
