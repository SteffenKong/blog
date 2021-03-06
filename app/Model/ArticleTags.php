<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * Class ArticleTags
 * @package App\Model
 */
class ArticleTags extends Pivot
{
    protected $table = 'article_tags';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'article_id',
        'tag_id',
        'created_at',
        'updated_at'
    ];
}
