<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;

/**
 * Class IndexController
 * @package App\Http\Controllers\Admin
 * 首页控制器
 */
class IndexController extends Controller {

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 首页
     */
    public function index() {
        return view('/admin/index/index');
    }

    /**
     * 推出登录
     */
    public function logout() {
        Session::forget('admin');
        return redirect('/admin/login');
    }
}
