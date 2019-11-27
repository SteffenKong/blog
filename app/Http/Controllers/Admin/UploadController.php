<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * Class UploadController
 * @package App\Http\Controllers\Admin
 * 文件上传控制器
 */
class UploadController extends BaseController {

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadFile(Request $request) {
        if ($request->isMethod('POST')) {
            $file = $request->file('file');
            if(!$file->isValid()) {
                return jsonPrint('001','文件非法');
            }

            //获取文件扩展名
            $ext = $file->getClientOriginalExtension();

            //获取文件当前的真实路径
            $path = $file->getRealPath();

            //构造文件名
            $fileName = date('Y-m-d H:i:s').'.'.$ext;

            //读取public的存储配置，读取临时上次的文件然后写到$fileName中即可,这样就实现了文件上次
            $res = Storage::disk('public')->put($fileName,file_get_contents($path));
            if(!$res) {
                return jsonPrint('001','文件上传失败');
            }
            $filePath =  Storage::url($fileName);
            return jsonPrint('000','文件上传成功',[
                'filePath' => $filePath
            ]);
        }else {
            return jsonPrint('002','非法访问');
        }
    }
}
