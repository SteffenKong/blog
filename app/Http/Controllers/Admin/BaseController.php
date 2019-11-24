<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\AdminException;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    protected $pageSize;

    public function __construct() {
        $this->pageSize = \config('blog.pageSize');
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

    public function isOwnId($id) {
        if(Session::get('admin')['id'] != $id) {
            return false;
        }
        return true;
    }
}
