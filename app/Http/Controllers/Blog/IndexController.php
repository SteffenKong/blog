<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;

/**
 * Class IndexController
 * @package App\Http\Controllers\Home
 * 博客首页
 */
class IndexController extends BaseController {

    public function __construct() {
        parent::__construct();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 首页
     */
    public function index() {
        //获取前10篇比较热的文章
        list($articles,$paginate) = $this->articleModel->getArticleByHot(10);
        return view('/blog/index/blog',compact('articles','paginate'));
    }


    /**
     * @return \Illuminate\Http\JsonResponse
     * 获取推荐文章标题
     */
    public function getRecArticleTitle() {
        $articles = $this->articleModel->getArticleByRec(6);
        return jsonPrint('000','获取成功',[
            'articles' => $articles
        ]);
    }


    /**
     * @return \Illuminate\Http\JsonResponse
     * 获取标签制作标签云
     */
    public function getTagsCloud() {
        $tags = $this->tagsModel->getAllTags();
        return jsonPrint('000','获取成功',[
            'tags' => $tags
        ]);
    }


    /**
     * @return \Illuminate\Http\JsonResponse
     * 获取友情链接
     */
    public function getLinks() {
        $links = $this->linksModel->getLinkByLimit(6);
        return jsonPrint('000','获取成功',['links' => $links]);
    }


    /**
     * @return \Illuminate\Http\JsonResponse
     * 获取父级分类
     */
    public function getCates() {
        $cates = $this->categotyModel->getParentCate(10);
        return jsonPrint('000','获取成功',['cates' => $cates]);
    }
}
