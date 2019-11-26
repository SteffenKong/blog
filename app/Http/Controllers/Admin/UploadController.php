<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

/**
 * Class UploadController
 * @package App\Http\Controllers\Admin
 * 文件上传控制器
 */
class UploadController extends BaseController {

    public function uploadFile(Request $request) {
        $image = $request->file('image');
    }
}
