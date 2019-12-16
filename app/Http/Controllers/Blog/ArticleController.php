<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;

/**
 * Class ArticleController
 * @package App\Http\Controllers\Blog
 * 文章详情控制器
 */
class ArticleController extends BaseController {

    public function __construct() {
        parent::__construct();
    }


    /**
     * @param int $articleId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 详情页界面
     */
    public function show(int $articleId) {
        $article = $this->articleModel::with('getDetails')->where('status',1)->find($articleId);
        $return = [];
        if(empty($article)) {
            throw new \Exception('文章不存在!');
        }
        $return = [
            'id' => $article->id,
            'title' => $article->title,
            'description' => $article->description,
            'smallImage' => $article->small_image,
            'status' => $article->status,
            'isHot' => $article->is_hot,
            'isRec' => $article->is_rec,
            'content' => $article->getDetails['content'],
            'viewNumber' => $article->view_number,
            'author' => $article->author,
            'createdAt' => $article->created_at,
            'updatedAt' => $article->updated_at
        ];
        return view('/blog/article/article',compact("articleId",'return'));
    }
}
