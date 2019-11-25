<?php

namespace App\Http\Requests;


class LinkAddRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|unique:link',
            'url' => 'required|unique:link',
            'status' => 'in:0,1',
            'sort' => 'numeric',
        ];
    }


    /**
     * @return array
     */
    public function messages() {
        return [
            'title.required' => '请填写友情链接名称',
            'title.unique' => '友情链接名称已存在',
            'url.required' => '请填写友情链接url',
            'url.unique' => '友情链接已存在',
            'status.in' => '状态值取值异常',
            'sort.numeric' => '排序值类型异常'
        ];
    }
}
