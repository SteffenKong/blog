<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * Class ArticleCategory
 * @package App\Model
 */
class ArticleCategory extends Pivot
{
    protected $table = 'article_category';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'article_id',
        'category_id',
        'created_at',
        'updated_at'
    ];
}
