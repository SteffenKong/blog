<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CommentVerifyRequest;
use Illuminate\Http\Request;
use App\Tools\Loader;
use App\Model\Comment;

/**
 * Class CommentController
 * @package App\Http\Controllers\Admin
 * 评论控制器
 */
class CommentController extends BaseController {

    /* @var Comment $commentModel */
    protected $commentModel;

    public function __construct() {
        parent::__construct();
        $this->commentModel = Loader::singleton(Comment::class);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 获取评论列表
     */
    public function index(Request $request) {
        $userName = $request->get('userName','');
        $email = $request->get('email','');
        $isVerify = $request->get('isVerify',-1);
        list($data,$paginate) = $this->commentModel->getListByAdmin($this->pageSize,$userName,$email,$isVerify);
        return view('/admin/comment/index',compact('data','paginate'));
    }


    /**
     * @param CommentVerifyRequest $request
     * @return \Illuminate\Http\JsonResponse
     * 审核
     */
    public function verify(CommentVerifyRequest $request) {
        $id = $request->get('id');
        $val = $request->get('val');
        if(!$this->commentModel->verify($id,$val)) {
            return jsonPrint('001','审核失败!');
        }
        return jsonPrint('000','审核成功');
    }


    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * 删除评论
     */
    public function delete(int $id) {
        if(!$this->commentModel->deleteData($id)) {
            return jsonPrint('001','删除失败!');
        }
        return jsonPrint('000','删除成功');
    }
}
