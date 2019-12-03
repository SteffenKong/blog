<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;

/**
 * Class ListController
 * @package App\Http\Controllers\Blog
 * 列表页控制器
 */
class ListController extends BaseController {

    public function __construct() {
        parent::__construct();
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 列表页
     */
    public function getListByCateId(int $cateId = -1) {
        list($data,$paginate) = $this->articleModel->getListByCateId(1,$cateId);
        $cates = $this->categotyModel->getParentCate(5);
        return view('/blog/list/list',compact('data','paginate','cates'));
    }


    /**
     * @param int $tagId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 列表页
     */
    public function getListByTagId(int $tagId = -1) {
        list($data,$paginate) = $this->articleModel->getListByTagId($this->pageSize,$tagId);
        $cates = $this->categotyModel->getParentCate(5);
        return view('/blog/list/list',compact('data','paginate','cates'));
    }


    /**
     * @param string $keyWords
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 列表页
     */
    public function getList($keyWords = '') {
        list($data,$paginate) = $this->articleModel->getListByBlog(1,$keyWords);
        $cates = $this->categotyModel->getParentCate(5);
        return view('/blog/list/list',compact('data','paginate','cates'));
    }
}
