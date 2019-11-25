<?php

namespace App\Http\Requests;

/**
 * Class AdminEditRequest
 * @package App\Http\Requests
 */
class AdminEditRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules()
    {
        return [
            'id'=>'required|numeric|notIn:0',
            'account'=>'required',
            'email'=>'required|email',
            'phone'=>'required'
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'id.required' => 'id不能为空',
            'id.numeric' => 'id类型异常',
            'id.notIn' => 'id不能为0',
            'account.required' => '请填写账号',
            'email.required' => '请填写邮箱',
            'email.email' => '邮箱格式不正确',
            'phone.required' => '请填写手机号码'
        ];
    }
}
