<?php

namespace App\Http\Requests;

/**
 * Class SystemSettingRequest
 * @package App\Http\Requests
 */
class SystemSettingRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'siteName' => 'required|max:19',
            'isCaptcha' => 'numeric'
        ];
    }

    /**
     * @return array
     */
    public function messages() {
        return [
            'siteName.required' => '请填写网站名称',
            'siteName.max' => '网站名称过长',
            'isCaptcha.numeric' => '开启验证码参数类型异常'
        ];
    }
}
