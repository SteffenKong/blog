<?php

namespace App\Http\Requests;


/**
 * Class TagsAddRequest
 * @package App\Http\Requests
 * 添加标签校验器
 */
class TagsEditRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'=>'required|numeric|notIn:0',
            'title' => 'required',
            'description' => 'max:150',
            'status' => 'in:0,1'
        ];
    }

    /**
     * @return array
     */
    public function  messages()
    {
        return [
            'id.required' => 'id不能为空',
            'id.numeric' => 'id类型异常',
            'id.notIn' => 'id不能为0',
            'title.required' => '请填写标签名称',
            'description.max' => '标签描述不能超过150个字符',
            'status.in' => '标签状态取值异常'
        ];
    }

}
