<?php

namespace App\Http\Controllers\Admin;

use App\Tools\Loader;
use Illuminate\Http\Request;

/**
 * Class ArticleController
 * @package App\Http\Controllers\Admin
 * 文章控制器s
 */
class ArticleController extends BaseController {

    protected $articleModel;

    public function __construct() {
        parent::__construct();
        $this->articleModel = Loader::singleton(Article::class);
    }


}
