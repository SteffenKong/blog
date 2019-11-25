<?php

namespace App\Http\Controllers\Admin;


use App\Http\Requests\CategoryAddRequest;
use App\Http\Requests\CategoryEditRequest;
use App\Tools\Loader;
use App\Model\Category;

/**
 * Class CategoryController
 * @package App\Http\Controllers\Admin
 * 分类控制器
 */
class CategoryController extends BaseController {


    /* @var Category $categoryModel */
    protected $categoryModel;

    public function __construct() {
        parent::__construct();
        $this->categoryModel = Loader::singleton(Category::class);
    }


    public function index() {
        list($data,$count) = $this->categoryModel->getListByAdmin();
        return view('/admin/category/index',compact('data','count'));
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\think\response\View
     * 添加分类模板
     */
    public function add() {
        $parentData = $this->categoryModel->getTree();
        return view('/admin/category/add',compact('parentData'));
    }


    /**
     * @param CategoryAddRequest $request
     * @return \Illuminate\Http\JsonResponse
     * 添加分类
     */
    public function doAdd(CategoryAddRequest $request) {
        $data = $request->post();
        if (!$this->categoryModel->add($data['title'],$data['pid'],$data['description'])) {
            return jsonPrint('001','添加失败!');
        }
        return jsonPrint('000','添加成功');
    }


    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View|\think\response\Redirect|\think\response\View
     * 分类编辑界面
     */
    public function edit(int $id) {
        $cate = $this->categoryModel->getOne($id);
        $parentData = $this->categoryModel->getTree();
        if(!$cate) {
            return redirect('/admin/category/index');
        }
        return view('/admin/category/edit',compact('cate','parentData'));
    }


    /**
     * @param CategoryEditRequest $request
     * @return \Illuminate\Http\JsonResponse
     * 编辑分类
     */
    public function doEdit(CategoryEditRequest $request) {
        $data = $request->post();

        //当前id不能选择自己作为父id
        //当前id不能选择自己的子类作为父id


        if(!$this->categoryModel->edit($data['id'],$data['title'],$data['pid'],$data['description'])) {
            return jsonPrint('001','编辑失败!');
        }
        return jsonPrint('000','编辑成功');
    }


    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * 删除分类
     */
    public function delete(int $id) {
        if(!empty($this->categoryModel->getSubChildrenIds($id))) {
            return jsonPrint('002','该分类下含有子节点,禁止删除!');
        }
        if(!$this->categoryModel->deleteData($id)) {
            return jsonPrint('001','删除失败!');
        }
        return jsonPrint('000','删除成功');
    }
}
