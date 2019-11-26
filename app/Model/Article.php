<?php

namespace App\Model;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Article
 * @package App\Model
 * 文章模型器
 */
class Article extends Model {

    public $timestamps = true;
    protected $table = 'article';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'title',
        'description',
        'big_image',
        'small_image',
        'status',
        'is_hot',
        'is_rec',
        'view_number',
        'author',
        'created_at',
        'updated_at'
    ];


    /**
     * @param $pageSize
     * @param $title
     * @param $status
     * @param $isHot
     * @param $isRec
     * @param $createdAt
     * @return array
     * 获取文章列表
     */
    public function getListByAdmin($pageSize,$title,$status,$isHot,$isRec,$createdAt) {
        $data = Article::when(!empty($title),function($query) use($title) {
            return $query->where('title','like','%'.$title.'%');
        })
        ->when($status != -1,function($query) use($status) {
            return $query->where('status',$status);
        })
        ->when($isRec != -1,function($query) use($isRec) {
            return $query->where('is_rec',$isRec);
        })
        ->when($isHot != -1,function($query) use($isHot) {
            return $query->where('is_hot',$isHot);
        })
        ->when($status != -1,function($query) use($createdAt) {
            return $query->where('created_at',$createdAt);
        })
        ->orderBy('created_at','desc')
        ->paginate($pageSize);

        $return = [];
        if(!empty($data)) {
            foreach ($data ?? [] as $article) {
                $return[] = [
                    'id' => $article->id,
                    'title' => $article->title,
                    'status' => $article->status,
                    'isHot' => $article->is_hot,
                    'smallImage' => $article->small_image,
                    'is_rec' => $article->is_rec,
                    'viewNumber' => $article->view_number,
                    'author' => $article->author,
                    'createdAt' => $article->created_at,
                    'updatedAt' => $article->updated_at
                ];
            }
        }
        return [$return,$data];
    }


    /**
     * @param $title
     * @param $description
     * @param $bigImage
     * @param $smallImage
     * @param $status
     * @param $isHot
     * @param $isRec
     * @param $author
     * @param $content
     * @param $cateIds
     * @param $tagIds
     * @return bool
     * 添加文章
     */
    public function add($title,$description,$bigImage,$smallImage,$status,$isHot,$isRec,$author,$content,$cateId,$tagIds) {
        $result = false;
        try {
            DB::beginTransaction();
            $result1 = Article::insert([
                'title' => $title,
                'description' => $description,
                'big_image' => $bigImage,
                'small_image' => $smallImage,
                'status' => $status,
                'is_hot' => $isHot,
                'is_rec' => $isRec,
                'author' => $author,
            ]);

            $result2 = ArticleDetails::insert([
                'article_id' => $result1->id,
                'content' => $content,
                'updated_at' => Carbon::now()->toDateTimeString()
            ]);

            $articleTagIds = [];
            foreach ($tagIds ?? [] as $tagId) {
                $articleTagIds[] = [
                    'id' => $result1->id,
                    'tag_id' => $tagId
                ];
            }

            $result3 = ArticleCategory::insert([
                'article_id'=>$result1->id,
                'category_id'=>$cateId
            ]);

            $result4 = ArticleTags::insert($articleTagIds);

            if($result1 && $result2 && $result3 && $result4) {
                $result = true;
            }
        }catch (\Exception $e) {
            $result = false;
        }

        if(!$result) {
            DB::rollback();
            return false;
        }

        DB::commit();
        return true;
    }



    /**
     * @param $id
     * @param $title
     * @param $description
     * @param $bigImage
     * @param $smallImage
     * @param $status
     * @param $isHot
     * @param $isRec
     * @param $author
     * @param $content
     * @param $cateId
     * @param $tagIds
     * @return bool
     * 编辑文章
     */
    public function edit($id,$title,$description,$bigImage,$smallImage,$status,$isHot,$isRec,$author,$content,$cateId,$tagIds) {
        $result = false;
        try {
            DB::beginTransaction();
            $result1 = Article::where('id',$id)->update([
                'title' => $title,
                'description' => $description,
                'big_image' => $bigImage,
                'small_image' => $smallImage,
                'status' => $status,
                'is_hot' => $isHot,
                'is_rec' => $isRec,
                'author' => $author,
            ]);

            $result2 = ArticleDetails::where('article_id',$result1->id)->update([
                'content' => $content,
                'updated_at' => Carbon::now()->toDateTimeString()
            ]);


            if(!empty($cateIds)) {
                $result3 = $this->asyncCateId($id,$cateId);
            }

            if(!empty($tagIds)) {
                $result4 = $this->asyncTagIds($id,$tagIds);
            }

            if($result1 && $result2 && $result3 && $result4) {
                $result = true;
            }
        }catch (\Exception $e) {
            $result = false;
        }

        if(!$result) {
            DB::rollback();
            return false;
        }

        DB::commit();
        return true;
    }



    /**
     * @param $articleId
     * @param $cateId
     * @return bool
     * 修改分类文章中间表
     */
    public function asyncCateId($articleId,$cateId) {
        $result = false;
        try {
            DB::beginTransaction();
            $result1 = ArticleCategory::where('article_id',$articleId)->delete();
            $result2 = ArticleCategory::insert([
                'article_id' => $articleId,
                'category_id' => $cateId
            ]);
            if($result1 && $result2) {
                $result = true;
            }
        }catch (\Exception $e) {
            $result = false;
        }

        if(!$result) {
            DB::rollback();
            return false;
        }

        DB::commit();
        return true;
    }


    /**
     * @param $articleId
     * @param $tagIds
     * @return bool
     * 修改文章标签中间表
     */
    public function asyncTagIds($articleId,$tagIds) {
        $result = false;
        try {
            DB::beginTransaction();
            $result1 = ArticleTags::where('article_id',$articleId)->delete();
            $articleTagIds = [];
            foreach ($tagIds ?? [] as $tagId) {
                $articleTagIds[] = [
                    'id' => $result1->id,
                    'tag_id' => $tagId
                ];
            }
            $result2 = ArticleTags::insert($articleTagIds);
            if($result1 && $result2) {
                $result = true;
            }
        }catch (\Exception $e) {
            $result = false;
        }

        if(!$result) {
            DB::rollback();
            return false;
        }

        DB::commit();
        return true;
    }


    /**
     * @param $articleId
     * @return mixed
     * 更换文章状态
     */
    public function changeStatus($articleId) {
        $status = 0;
        $oldStatus = Article::where('id',$articleId)->value('status');
        if(!$oldStatus) {
            $status = 1;
        }
        return Article::where('id',$articleId)->update([
            'status' => $status,
            'updated_at' => Carbon::now()->toDateTimeString()
        ]);
    }


    /**
     * @param $articleId
     * @return bool
     * 删除单篇文章
     */
    public function deleteOne($articleId) {
        $result = false;
        try {
            DB::beginTransaction();
            $result1 = Article::where('id',$articleId)->delete();
            $result2 = ArticleCategory::where('article_id',$articleId)->delete();
            $result3 = ArticleTags::where('article_id',$articleId)->delete();
            if($result1 && $result2 && $result3) {
                $result = true;
            }
        }catch (\Exception $e) {
            $result = false;
        }

        if(!$result) {
            DB::rollBack();
            return false;
        }
        DB::commit();
        return true;
    }



    /**
     * @param $articleIds
     * @return bool
     * 删除多篇文章
     */
    public function deleteAll($articleIds) {
        $result = false;
        try {
            DB::beginTransaction();
            $result1 = Article::whereIn('id',$articleIds)->delete();
            $result2 = ArticleCategory::whereIn('article_id',$articleIds)->delete();
            $result3 = ArticleTags::whereIn('article_id',$articleIds)->delete();
            if($result1 && $result2 && $result3) {
                $result = true;
            }
        }catch (\Exception $e) {
            $result = false;
        }

        if(!$result) {
            DB::rollBack();
            return false;
        }
        DB::commit();
        return true;
    }



    /**
     * @param $articleId
     * @return array
     * 获取指定文章数据
     */
    public function getOne($articleId) {
        $return = [];
        $article = Article::find($articleId);
        if($article) {
            $return = [
                'id' => $article->id,
                'title' => $article->title,
                'description' => $article->description,
                'bigImage' => $article->big_image,
                'smallImage' => $article->small_image,
                'status' => $article->status,
                'isHot' => $article->is_hot,
                'isRec' => $article->is_rec,
                'viewNumber' => $article->viewNumber,
                'author' => $article->author,
                'createdAt' => $article->created_at,
                'updatedAt' => $article->updated_at,
                'content' => ArticleDetails::where('article_id',$article->id)->first()
            ];
        }
        return $return;
    }
}
