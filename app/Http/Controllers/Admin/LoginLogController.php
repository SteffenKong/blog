<?php

namespace App\Http\Controllers\Admin;

use App\Model\LoginLog;
use App\Tools\Loader;
use App\Http\Controllers\Controller;

/**
 * Class LoginLogController
 * @package App\Http\Controllers\Admin
 * 登录日志
 */
class LoginLogController extends Controller {

    /* @var LoginLog $loginLogModel */
    protected $loginLogModel;

    public function __construct() {
        $this->loginLogModel = Loader::singleton(LoginLog::class);
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $data = $this->loginLogModel->getList();
        return view('/admin/loginlog/index',compact('data'));
    }
}
