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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 详情页界面
     */
    public function show() {
        return view('/blog/article/show');
    }


    /**
     * @param int $articleId
     * @return \Illuminate\Http\JsonResponse
     * 获取文章详情数据
     */
    public function getArticle(int $articleId) {
        $article = $this->articleModel::with('getDetails')->find($articleId);
        $return = [];
        if(empty($article)) {
            return jsonPrint('001','获取失败',$return);
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

        return jsonPrint('000','获取成功',$return);
    }
}
