<?php

namespace App\Http\Controllers\Admin;

use App\Model\AdminLog;
use App\Tools\Loader;
use App\Http\Controllers\Controller;

/**
 * Class AdminLogController
 * @package App\Http\Controllers\Admin
 * 管理员操作日志
 */
class AdminLogController extends Controller {

    /* @var AdminLog $adminLog*/
    protected $adminLog;

    public function __construct() {
        $this->adminLog = Loader::singleton(AdminLog::class);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \MongoDB\Driver\Exception\Exception
     */
    public function index() {
        $data = $this->adminLog->getList();
        return view('/admin/adminlog/index',compact('data'));
    }
}
