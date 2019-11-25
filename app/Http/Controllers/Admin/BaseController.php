<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Exceptions\AdminException;
use App\Model\Admin;
use App\Tools\Loader;

/**
 * Class BaseController
 * @package App\Http\Controllers\Admin
 * 基类控制器
 */
class BaseController extends Controller
{

    /**
     * @var \Illuminate\Config\Repository|mixed
     * 分页数
     */
    protected $pageSize;

    /* @var Admin $adminModel */
    protected $adminModel;

    public function __construct() {
        $this->pageSize = \config('blog.pageSize');
        $this->adminModel = Loader::singleton(Admin::class);
    }


    /**
     * @param $id
     * @throws AdminException
     */
    public function isOwn($id) {
        if(Session::get('admin')['id'] == $id) {
            throw new AdminException('不能操作本身自己!');
        }
        return true;
    }

    /**
     * @param $id
     * @return bool
     */
    public function isOwnId($id) {
        if(Session::get('admin')['id'] != $id) {
            return false;
        }
        return true;
    }


    /**
     * @return mixed
     * 获取当前登录管理员的id
     */
    public function getAdminId() {
        return Session::get('admin')['id'];
    }


    /**
     * @return array|bool
     * @throws AdminException
     * 获取当前登录的管理员信息
     */
    public function getAdminInfo() {
        $adminId = $this->getAdminId();
        $admin = $this->adminModel->getOne($adminId);
        if(empty($admin)) {
            throw new AdminException('管理员不存在!');
        }
        return $admin;
    }
}
