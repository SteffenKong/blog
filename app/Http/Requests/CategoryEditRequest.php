<?php

namespace App\Http\Requests;

/**
 * Class CategoryAddRequest
 * @package App\Http\Requests
 * 分类编辑表单
 */
class CategoryEditRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|numeric',
            'title' => 'required',
            'description' => 'max:150',
            'pid' => 'required|numeric',
        ];
    }


    public function messages() {
        return [
            'id.required' => 'id不能为空',
            'id.numeric' => 'id类型异常',
            'id.notIn' => 'id不能为0',
            'title.required' => '请填写分类名称',
            'description.max' => '分类描述最多填写150个字符',
            'pid.required' => '请选择所属分类',
            'pid.numeric' => '所属分类取值异常'
        ];
    }
}
