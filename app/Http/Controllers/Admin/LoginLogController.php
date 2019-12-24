<?php

namespace App\Http\Controllers\Admin;

use App\Model\LoginLog;
use App\Tools\Page;
use App\Tools\Loader;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Class LoginLogController
 * @package App\Http\Controllers\Admin
 * 登录日志
 */
class LoginLogController extends BaseController {

    /* @var LoginLog $loginLogModel */
    protected $loginLogModel;

    public function __construct() {
        parent::__construct();
        $this->loginLogModel = Loader::singleton(LoginLog::class);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 首页
     */
    public function index(Request $request) {
        $page = $request->get('page',1);
        $pageSize = $this->pageSize;
        list($data,$count) = $this->loginLogModel->getList($page,$pageSize);
        $pages = ceil($count/$this->pageSize);
        $page = Page::getPageHtml($page,$pages,$request->getUri(),5);
        return view('/admin/loginlog/index',compact('data','count','page','pageSize'));
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * 删除登录日志
     */
    public function delete(Request $request) {
        $id = $request->get('id');
        if(empty($id)) {
            return jsonPrint('001','id非法!');
        }
        if($this->loginLogModel->delData($id)) {
            return jsonPrint('000','删除成功');
        }
        return jsonPrint('001','删除失败!');
    }
}
