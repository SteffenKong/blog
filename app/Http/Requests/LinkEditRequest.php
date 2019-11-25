<?php

namespace App\Http\Requests;


/**
 * Class LinkEditRequest
 * @package App\Http\Requests
 */
class LinkEditRequest extends BaseRequest
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
            'url' => 'required',
            'status' => 'in:0,1',
            'sort' => 'numeric',
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
            'title.required' => '请填写友情链接名称',
            'url.required' => '请填写友情链接url',
            'status.in' => '状态值取值异常',
            'sort.numeric' => '排序值类型异常'
        ];
    }
}
