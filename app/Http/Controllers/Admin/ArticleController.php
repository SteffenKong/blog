<?php

namespace App\Http\Controllers\Admin;

use App\Model\Article;
use App\Tools\Loader;
use App\Model\Tags;
use App\Model\Category;
use Illuminate\Http\Request;
use App\Http\Requests\ArticleAddRequest;
use App\Http\Requests\ArticleEditRequest;


/**
 * Class ArticleController
 * @package App\Http\Controllers\Admin
 * 文章控制器
 */
class ArticleController extends BaseController {

    /* @var Article $articleModel */
    protected $articleModel;

    /* @var Tags $tagsModel */
    protected $tagsModel;

    /* @var Category $categoryModel */
    protected $categoryModel;

    public function __construct() {
        parent::__construct();
        $this->articleModel = Loader::singleton(Article::class);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 文章首页
     */
    public function index(Request $request) {
        $title = $request->get('title','');
        $status = $request->get('status',-1);
        $isHot = $request->get('isHot','');
        $isRec = $request->get('isRec','');
        $createdAt = $request->get('createdAt','');
        list($data,$paginate) = $this->articleModel->getListByAdmin($this->pageSize,$title,$status,$isHot,$isRec,$createdAt);
        return view('/admin/article/index',compact('data','paginate'));
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 添加文章
     */
    public function add() {
        //取出所有文章分类
        $allCate =  $this->categoryModel->getTree();
        //取出所有文章标签
        $allTags = $this->tagsModel->getAllTags();
        return view('/admin/article/add',compact('allCate','allTags'));
    }


    /**
     * @param ArticleAddRequest $request
     * @return \Illuminate\Http\JsonResponse
     * 发布文章
     */
    public function doAdd(ArticleAddRequest $request) {
        $data = $request->post();
        if(!$this->articleModel->add($data['title'],$data['description'],$data['bigImage'],$data['smallImage'],$data['status'],$data['isHot'],$data['isRec'],$data['author'],$data['content'])) {
            return jsonPrint('001','发布失败!');
        }
        return jsonPrint('000','发布成功');
    }



    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 编辑文章
     */
    public function edit(int $id) {
        //取出所有文章分类
        $allCate =  $this->categoryModel->getTree();
        //取出所有文章标签
        $allTags = $this->tagsModel->getAllTags();
        //取出旧数据
        $article = $this->articleModel->getOne($id);
        return view('/admin/article/edit',compact('allCate','allTags','article'));
    }



    /**
     * @param ArticleEditRequest $request
     * @return \Illuminate\Http\JsonResponse
     * 编辑文章
     */
    public function doEdit(ArticleEditRequest $request) {
        $data = $request->post();
        if(!$this->articleModel->edit($data['id'],$data['title'],$data['description'],$data['bigImage'],$data['smallImage'],$data['status'],$data['isHot'],$data['isRec'],$data['author'],$data['content'])) {
            return jsonPrint('001','编辑失败!');
        }
        return jsonPrint('000','编辑成功');
    }


    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * 删除文章
     */
    public function delete(int $id) {
        if(!$this->articleModel->deleteData($id)) {
            return jsonPrint('001','删除失败!');
        }
        return jsonPrint('000','删除成功');
    }



    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * 更改文章状态
     */
    public function changeStatus(int $id) {
        if(!$this->articleModel->changeStatus($id)) {
            return jsonPrint('001','删除失败!');
        }
        return jsonPrint('000','删除成功');
    }
}
