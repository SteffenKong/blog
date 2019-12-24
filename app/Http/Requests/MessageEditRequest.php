<?php

namespace App\Http\Requests;

use Faker\Provider\Base;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class MessageEditRequest
 * @package App\Http\Requests
 */
class MessageEditRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|numeric|notIn:0',
            'title' => 'required|max:190',
            'content' => 'required|max:190'
        ];
    }


    /**
     * @return array
     */
    public function messages() {
        return [
            'id.required' => 'id不能为空',
            'id.numeric' => 'id类型异常',
            'id.notIn' => 'id不能为0',
            'title.required' => '请填写公告标题',
            'title.max' => '公告标题字数不能超过190个字符',
            'content.required' => '请填写公告内容',
            'content.max' => '公告内容字数不能超过190个字符'
        ];
    }
}
