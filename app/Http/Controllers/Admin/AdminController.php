<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AdminAddRequest;
use App\Http\Requests\AdminEditRequest;
use App\Tools\Loader;
use App\Model\Admin;
use Illuminate\Http\Request;

/**
 * Class AdminController
 * @package App\Http\Controllers\Admin
 * 管理员控制器
 */
class AdminController extends BaseController {

    public function __construct() {
        parent::__construct();
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 管理员首页
     */
    public function index(Request $request) {
        $email = $request->get('email','');
        $phone = $request->get('phone','');
        $account = $request->get('account','');
        $status = $request->get('status',-1);
        list($data,$paginate) = $this->adminModel->getList($this->pageSize,$account, $email, $phone,$status);
        return view('/admin/admin/index',compact('data','paginate'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 添加表单
     */
    public function add() {
        return view('/admin/admin/add');
    }


    /**
     * @param AdminAddRequest $request
     * @return \Illuminate\Http\JsonResponse
     * 添加管理员
     */
    public function doAdd(AdminAddRequest $request) {
        $data = $request->post();
        $res = $this->adminModel->add($data['account'],$data['password'],$data['email'],$data['phone'],$data['status'],'');
        if(!$res) {
            return jsonPrint('001','添加失败!');
        }
        return jsonPrint('000','添加成功');
    }


    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 编辑模板
     */
    public function edit(int $id) {
        $admin = $this->adminModel->getOne($id);
        if($this->getAdminId() != 1 && !$this->isOwnId($id)) {
            return redirect('/admin/admin/index');
        }
        if(empty($admin)) {
            return redirect('/admin/admin/index');
        }
        return view('/admin/admin/edit',compact('admin'));
    }


    /**
     * @param AdminEditRequest $request
     * @return \Illuminate\Http\JsonResponse
     * 编辑动作
     */
    public function doEdit(AdminEditRequest $request) {
        $data = $request->post();
        if($this->adminModel->getColumnIsExistsExceptAdminId($data['id'],'account',$data['account'])) {
            return jsonPrint('002','账号已存在!');
        }
        if($this->adminModel->getColumnIsExistsExceptAdminId($data['id'],'email',$data['email'])) {
            return jsonPrint('002','邮箱已存在!');
        }
        if($this->adminModel->getColumnIsExistsExceptAdminId($data['id'],'phone',$data['phone'])) {
            return jsonPrint('002','手机号码已存在!');
        }
        if(!$this->adminModel->edit($data['id'],$data['account'],$data['password'],$data['email'],$data['phone'],$data['status'],'')) {
            return jsonPrint('001','编辑失败!');
        }
        return jsonPrint('000','编辑成功');
    }


    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\AdminException
     * 删除管理员
     */
    public function delete(int $id) {
        if($id == 1) {
            return jsonPrint('001','超级管理员不能删除!');
        }
        $this->isOwn($id);
        if(!$this->adminModel->deleteData($id)) {
            return jsonPrint('001','删除失败!');
        }
        return jsonPrint('000','删除成功');
    }


    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\AdminException
     * 更新状态
     */
    public function changeStatus(int $id) {
        if($id == 1) {
            return jsonPrint('001','超级管理员不能更改状态!');
        }
        $this->isOwn($id);
        if(!$this->adminModel->changeStatus($id)) {
            return jsonPrint('001','更新失败!');
        }
        return jsonPrint('000','更新成功');
    }
}
