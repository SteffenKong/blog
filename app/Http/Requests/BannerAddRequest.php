<?php

namespace App\Http\Requests;

/**
 * Class BannerAddRequest
 * @package App\Http\Requests
 */
class BannerAddRequest extends BaseRequest {
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'title' => 'required|unique:banner',
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
            'title.required' => '请填写横幅名称',
            'title.unique' => '横幅名称已存在',
            'image.required' => '请上传图片',
            'status.required' => '请选择状态',
            'status.in' => '状态取值异常'
        ];
    }
}
