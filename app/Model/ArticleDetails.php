<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ArticleDetails
 * @package App\Model
 * 文章-详情中间模型
 */
class ArticleDetails extends Model {

    protected $table = 'article_details';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'article_id',
        'content',
        'created_at',
        'updated_at'
    ];
}
