<?php

namespace App\Http\Requests;

/**
 * Class MessageAddRequest
 * @package App\Http\Requests
 */
class MessageAddRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:190',
            'content' => 'required|max:190'
        ];
    }

    /**
     * @return array
     */
    public function messages() {
        return [
            'title.required' => '请填写公告标题',
            'title.max' => '公告标题字数不能超过190个字符',
            'content.required' => '请填写公告内容',
            'content.max' => '公告内容字数不能超过190个字符'
        ];
    }
}
