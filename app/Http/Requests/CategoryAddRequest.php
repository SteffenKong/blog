<?php

namespace App\Http\Requests;

/**
 * Class CategoryAddRequest
 * @package App\Http\Requests
 * 分类添加表单
 */
class CategoryAddRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|unique:category',
            'description' => 'max:150',
            'pid' => 'required|numeric',
        ];
    }


    public function messages() {
       return [
            'title.required' => '请填写分类名称',
            'title.unique' => '分类名称已存在',
            'description.max' => '分类描述最多填写150个字符',
            'pid.required' => '请选择所属分类',
            'pid.numeric' => '所属分类取值异常'
       ];
    }
}
