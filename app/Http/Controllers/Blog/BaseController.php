<?php

namespace App\Http\Controllers\Blog;

use App\Model\Article;
use App\Model\Banner;
use App\Model\Category;
use App\Model\Link;
use App\Model\Tags;
use App\Tools\Loader;
use App\Http\Controllers\Controller;
use phpDocumentor\Reflection\DocBlock\Tag;

/**
 * Class BaseController
 * @package App\Http\Controllers\Blog
 * 基础控制器
 */
class BaseController extends Controller {

    /* @var Article $articleModel */
    protected $articleModel;

    /* @var Tags $tagsModel */
    protected $tagsModel;

    /* @var Banner $bannerModel */
    protected $bannerModel;

    /* @var Link $linksModel */
    protected $linksModel;

    /* @var Category $categotyModel */
    protected $categotyModel;


    protected $pageSize;

    /**
     * BaseController constructor
     */
    public function __construct() {
        $this->articleModel = Loader::singleton(Article::class);
        $this->tagsModel = Loader::singleton(Tags::class);
        $this->bannerModel = Loader::singleton(Banner::class);
        $this->linksModel = Loader::singleton(Link::class);
        $this->categotyModel = Loader::singleton(Category::class);
        $this->pageSize = \config('blog.blog.pageSize');
    }


    public function showCates() {
        $cates = $this->categotyModel->getParentCate(5);
        return view('/blog/list/list',compact('cates'));
    }
}
