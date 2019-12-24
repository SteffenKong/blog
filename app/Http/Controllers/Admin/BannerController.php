<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BannerAddRequest;
use App\Http\Requests\BannerEditRequest;
use App\Tools\Loader;
use App\Model\Banner;
use Illuminate\Http\Request;

/**
 * Class BannerController
 * @package App\Http\Controllers\Admin
 * 横幅控制器
 */
class BannerController extends BaseController {

    /* @var Banner $bannerModel */
    protected $bannerModel;

    public function __construct() {
        parent::__construct();
        $this->bannerModel = Loader::singleton(Banner::class);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 横幅列表
     */
    public function index(Request $request) {
        $title = $request->get('title','');
        $status = $request->get('status',-1);
        list($data,$paginate) = $this->bannerModel->getListByAdmin( $this->pageSize,$title,$status);
        return view('/admin/banner/index',compact('data','paginate'));
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 横幅添加界面
     */
    public function add() {
        return view('/admin/banner/add');
    }


    /**
     * @param BannerAddRequest $request
     * @return \Illuminate\Http\JsonResponse
     * 添加横幅
     */
    public function doAdd(BannerAddRequest $request) {
        $data = $request->post();
        if(!$this->bannerModel->add($data['title'],$data['image'],$data['status'])) {
            return jsonPrint('001','添加失败!');
        }
        return jsonPrint('000','添加成功');
    }


    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     * 编辑模板
     */
    public function edit(int $id) {
        $banner = $this->bannerModel->getOne($id);
        if(!$banner) {
            return jsonPrint('002','横幅不存在!');
        }
        return view('/admin/banner/edit',compact('banner'));
    }


    /**
     * @param BannerEditRequest $request
     * @return \Illuminate\Http\JsonResponse
     * 编辑横幅
     */
    public function doEdit(BannerEditRequest $request) {
        $data = $request->post();

        if($this->bannerModel->checkTitleIsExistsExcepId($data['id'],$data['title'])) {
            return jsonPrint('002','横幅名称已存在!');
        }

        if(!$this->bannerModel->edit($data['id'],$data['title'],$data['image'],$data['status'])) {
            return jsonPrint('001','编辑失败!');
        }
        return jsonPrint('000','编辑成功');
    }


    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * 更改状态
     */
    public function changeStatus(int $id) {
        if(!$this->bannerModel->changeStatus($id)) {
            return jsonPrint('001','更改失败!');
        }
        return jsonPrint('000','更改成功');
    }


    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * 删除横幅
     */
    public function delete(int $id) {
        if (!$this->bannerModel->deleteData($id)) {
            return jsonPrint('001','删除失败!');
        }
        return jsonPrint('000','删除成功');
    }
}
