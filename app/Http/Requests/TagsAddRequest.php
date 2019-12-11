<?php

namespace App\Http\Requests;


/**
 * Class TagsAddRequest
 * @package App\Http\Requests
 * 添加标签校验器
 */
class TagsAddRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|unique:tags',
            'description' => 'required|max:150',
            'status' => 'in:0,1'
        ];
    }

    /**
     * @return array
     */
    public function  messages()
    {
        return [
            'title.required' => '请填写标签名称',
            'title.unique' => '标签名称已存在',
            'description.required' => '请填写标签描述',
            'description.max' => '标签描述不能超过150个字符',
            'status.in' => '标签状态取值异常'
        ];
    }

}
