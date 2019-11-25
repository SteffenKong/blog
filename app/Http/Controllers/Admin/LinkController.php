<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\LinkEditRequest;
use App\Http\Requests\LinkAddRequest;
use Illuminate\Http\Request;
use App\Tools\Loader;
use App\Model\Link;

/**
 * Class LinkController
 * @package App\Http\Controllers\Admin
 * 友情链接控制器
 */
class LinkController extends BaseController {


    /* @var Link $linkModel */
    protected $linkModel;

    public function __construct() {
        parent::__construct();
        $this->linkModel = Loader::singleton(Link::class);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\think\response\View
     * 友情链接列表
     */
    public function index(Request $request) {
        $title = $request->get('title','');
        $url = $request->get('url','');
        $status = $request->get('status',-1);
        list($data,$paginate) = $this->linkModel->getList($this->pageSize,$title,$url,$status);
        return view('/admin/link/index',compact('data','paginate'));
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\think\response\View
     * 友情链接添加模板
     */
    public function add() {
        return view('/admin/link/add');
    }


    /**
     * @param LinkAddRequest $request
     * @return \Illuminate\Http\JsonResponse
     * 添加友情链接
     */
    public function doAdd(LinkAddRequest $request) {
        $data = $request->post();

        if(!$this->linkModel->add($data['title'],$data['url'],$data['status'])) {
            return jsonPrint('001','添加失败!');
        }
        return jsonPrint('000','添加成功');
    }


    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View|\think\response\Redirect|\think\response\View
     * 友情链接编辑界面
     */
    public function edit(int $id) {
        $link = $this->linkModel->getOne($id);
        if(!$link) {
            return redirect('/admin/link/index');
        }
        return view('/admin/link/edit',compact('link'));
    }



    /**
     * @param LinkEditRequest $request
     * @return \Illuminate\Http\JsonResponse
     * 编辑友情链接
     */
    public function doEdit(LinkEditRequest $request) {
        $data = $request->post();

        if($this->linkModel->getUrlIsExistsExceptId($data['id'],$data['url'])) {
            return jsonPrint('002','友情链接已存在!');
        }

        if($this->linkModel->getTitleIsExistsExceptId($data['id'],$data['title'])) {
            return jsonPrint('002','友情链接名称已存在!');
        }

        if(!$this->linkModel->edit($data['id'],$data['title'],$data['url'],$data['status'])) {
            return jsonPrint('001','添加失败!');
        }
        return jsonPrint('000','添加成功');
    }


    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * 删除友情链接
     */
    public function delete(int $id) {
        if(!$this->linkModel->deleteData($id)) {
            return jsonPrint('001','删除失败!');
        }
        return jsonPrint('000','删除成功!');
    }


    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * 编辑友情链接状态
     */
    public function changeStatus(int $id) {
        if(!$this->linkModel->changeStatus($id)) {
            return jsonPrint('001','编辑失败!');
        }
        return jsonPrint('000','编辑成功!');
    }
}
