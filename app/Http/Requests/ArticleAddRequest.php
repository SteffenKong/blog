<?php

namespace App\Http\Requests;


/**
 * Class ArticleAddRequest
 * @package App\Http\Requests
 */
class ArticleAddRequest extends BaseRequest {
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:30|unique:article',
            'description' => 'required|max:150',
            'status' => 'in:0,1',
            'isHot' => 'in:0,1',
            'isRec' => 'in:0,1',
            'categoryId' => 'notIn:-1|numeric',
            'content' => 'required|max:4000'
        ];
    }


    /**
     * @return array
     */
    public function messages() {
        return [
            'categoryId.notIn' => '请选择分类id',
            'categoryId.numeric' => '分类id类型异常',
            'title.required' => '请填写标题',
            'title.max' => '标题最多只能填写30个字符',
            'title.unique' => '标题已存在',
            'description.required' => '请填写文章简介内容',
            'description.max' => '文章简介最多只能填写150个字符',
            'status.in' => '文章状态值取值异常',
            'isHot.in' => '文章热销值取值异常',
            'isRec.in' => '文章推荐值取值异常',
            'content.required' => '请输入文章内容',
            'content.max' => '文章内容最多只能输入4000个字符',
        ];
    }
}
