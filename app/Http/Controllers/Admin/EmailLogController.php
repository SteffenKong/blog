<?php

namespace App\Http\Controllers\Admin;

use App\Model\EmailLog;
use App\Tools\Loader;
use Illuminate\Http\Request;

/**
 * Class EmailLogController
 * @package App\Http\Controllers\Admin
 * 邮箱发送控制器
 */
class EmailLogController extends BaseController
{

    /* @var EmailLog */
    protected $emailLogModel;

    /**
     * EmailLogController constructor.
     */
    public function __construct() {
        parent::__construct();
        $this->emailLogModel = Loader::singleton(EmailLog::class);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 获取列表
     */
    public function getList(Request $request) {
        list($paginate,$data) = $this->emailLogModel->getList($this->pageSize);
        return view('/admin/emaillog/index',compact('paginate','data'));
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * 删除
     */
    public function delete(Request $request) {
        $id = $request->get('id');
        if(empty($id)) {
            return jsonPrint('001','id非法!');
        }
        if($this->emailLogModel->delData($id)) {
            return jsonPrint('000','删除成功');
        }
        return jsonPrint('001','删除失败!');
    }
}
