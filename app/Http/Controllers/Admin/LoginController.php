<?php

namespace App\Http\Controllers\Admin;

use App\Events\LoginEvent;
use App\Http\Requests\LoginRequest;
use App\Tools\Loader;
use App\Model\Admin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class LoginController
 * @package App\Http\Controllers\Admin
 */
class LoginController extends Controller {

    public function login() {
        return view('/admin/login/login');
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * 登录动作
     */
    public function sign(LoginRequest $request) {
        $account = $request->get('account');
        $password = $request->get('password');

        /* @var Admin $adminModel */
        $adminModel = Loader::singleton(Admin::class);
        $admin = $adminModel->login($account,$password);

        if(!$admin) {
            return jsonPrint('001','登录失败!');
        }

        if (!$adminModel->checkStatus($admin['id'])) {
            return jsonPrint('002','管理员未激活!');
        }
        \
        event(new LoginEvent($admin,Carbon::now()->toDateTimeString(),$request->getClientIp(),$admin['email'],$admin['phone']));

        return jsonPrint('000','登录成功');
    }


    /**
     * @return \Illuminate\Http\JsonResponse
     * 获取公钥
     */
    public function getPublicKey() {
        return jsonPrint('000','获取成功',['publicKey'=>\config('blog.admin.publicKey')]);
    }
}
