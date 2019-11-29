<?php

namespace App\Http\Requests;

/**
 * Class BannerEditRequest
 * @package App\Http\Requests
 */
class BannerEditRequest extends BaseRequest {
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'id'=>'required|numeric|notIn:0',
            'title' => 'required',
            'image' => 'required',
            'status' => 'required|in:0,1',
        ];
    }

    /**
     * @return array
     * 获取错误消息
     */
    public function messages() {
        return [
            'id.required' => 'id不能为空',
            'id.numeric' => 'id类型异常',
            'id.notIn' => 'id不能为0',
            'title.required' => '请填写横幅名称',
            'image.required' => '请上传图片',
            'status.required' => '请选择状态',
            'status.in' => '状态取值异常'
        ];
    }
}
