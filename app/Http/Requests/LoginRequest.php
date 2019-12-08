<?php

namespace App\Http\Requests;
use App\Model\SystemSetting;
use App\Tools\Loader;


/**
 * Class LoginRequest
 * @package App\Http\Requests
 *  登录校验器
 */
class LoginRequest extends BaseRequest {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        /* @var SystemSetting $systemSetting */
        $systemSetting = Loader::singleton(SystemSetting::class);
        $setting = $systemSetting->getSetting();
        $return = [];
        if($setting['isCaptcha'] == 1) {
            $return = [
                    'account'=>'required',
                    'password'=>'required',
                    'captcha'=>'required|captcha'
                ];
        }else {
            $return = [
                'account'=>'required',
                'password'=>'required',
            ];
        }
        return $return;
    }


    /**
     * @return array
     */
    public function messages() {
        /* @var SystemSetting $systemSetting */
        $systemSetting = Loader::singleton(SystemSetting::class);
        $setting = $systemSetting->getSetting();
        $return = [];
        if($setting['isCaptcha'] == 1) {
            $return = [
                'account.required'=>'请填写账号',
                'password.required'=>'请填写密码',
                'captcha.required'=>'请填写验证码',
                'captcha.captcha'=>'验证码失败'
            ];
        }else {
            $return = [
                'account.required'=>'请填写账号',
                'password.required'=>'请填写密码'
            ];
        }
        return $return;
    }
}
