<?php

namespace App\Http\Requests;

/**
 * Class CommentVerifyRequest
 * @package App\Http\Requests
 */
class CommentVerifyRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'id'=>'required|numeric|notIn:0',
            'val' => 'required|numeric|In:0,1,2'
        ];
    }


    /**
     * @return array
     */
    public function message() {
        return [
            'id.required' => 'id不能为空',
            'id.numeric' => 'id类型异常',
            'id.notIn' => 'id不能为0',
            'val.required' => '请选择审核状态',
            'val.numeric' => '审核值类型异常',
            'val.In' => '审核值异常',
        ];
    }
}
