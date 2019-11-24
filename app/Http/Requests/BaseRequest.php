<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class BaseRequest extends FormRequest
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
     * @param Validator $validator
     * 统一获取错误信息的api接口格式
     */
    public function failedValidation(Validator $validator)
    {
        exit(json_encode([
            'status'=>'004',
            'message'=>'错误信息',
            'errors'=>$validator->getMessageBag()->toArray()
        ]));
    }
}
