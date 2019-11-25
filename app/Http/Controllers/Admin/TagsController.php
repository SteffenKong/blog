<?php

namespace App\Http\Controllers\Admin;

use App\Model\Tags;
use App\Tools\Loader;
use Illuminate\Http\Request;
use App\Http\Requests\TagsAddRequest;
use App\Http\Requests\TagsEditRequest;


/**
 * Class TagsController
 * @package App\Http\Controllers\Admin
 * 标签控制器
 */
class TagsController extends BaseController {

    /* @var Tags $tagsModel */
    protected $tagsModel;

    public function __construct() {
        parent::__construct();
        $this->tagsModel = Loader::singleton(Tags::class);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\think\response\View
     * 分页获取标签
     */
    public function index(Request $request) {
        $title = $request->get('title','');
        $status = $request->get('status',-1);
        list($data,$paginate) = $this->tagsModel->getList($this->pageSize,$title,$status);
        return view('/admin/tags/index',compact('data','paginate'));
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\think\response\View
     * 添加标签界面
     */
    public function add() {
        return view('/admin/tags/add');
    }

    /**
     * @param TagsAddRequest $request
     * @return \Illuminate\Http\JsonResponse
     * 添加标签
     */
    public function doAdd(TagsAddRequest $request) {
        $data = $request->post();

        if(!$this->tagsModel->add($data['title'],$data['description'],$data['status'])) {
            return jsonPrint('001','添加失败');
        }
        return jsonPrint('000','添加成功');
    }


    /**
     * @param int $id
     * @return array|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\think\response\Redirect
     * 标签编辑界面
     */
    public function edit(int $id) {
        $tag = $this->tagsModel->getOne($id);
        if(empty($tag)) {
            return redirect('/admin/tags/index');
        }
        return view('/admin/tags/edit',compact('tag'));
    }


    /**
     * @param TagsEditRequest $request
     * @return \Illuminate\Http\JsonResponse
     * 编辑标签
     */
    public function doEdit(TagsEditRequest $request) {
        $data = $request->post();

        if($this->tagsModel->getTitleExistsExcepId($data['id'],$data['title'])) {
            return jsonPrint('002','标签名已存在');
        }

        if(!$this->tagsModel->edit($data['id'],$data['title'],$data['description'],$data['status'])) {
            return jsonPrint('001','编辑失败');
        }
        return jsonPrint('000','编辑成功');
    }


    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * 删除标签
     */
    public function delete(int $id) {
        if(!$this->tagsModel->deleteData($id)) {
            return jsonPrint('001','删除失败');
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
        if(!$this->tagsModel->changeStatus($id)) {
            return jsonPrint('001','更新失败!');
        }
        return jsonPrint('000','更新成功');
    }


    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\think\response\View
     * 获取标签简介
     */
    public function getDescriptionById(int $id) {
        $description = $this->tagsModel->getDescriptionById($id);
        return view('/admin/tags/content',compact('description'));
    }
}
