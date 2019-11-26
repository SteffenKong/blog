<?php

namespace App\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Tags
 * @package App\Model
 * 标签模型
 */
class Tags extends Model {

    protected $primaryKey = 'id';
    protected $table = 'tags';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'title',
        'status',
        'description',
        'created_at',
        'updated_at'
    ];


    /**
     * @param $pageSize
     * @param $title
     * @param $status
     * @return array
     * 获取标签列表
     */
    public function getList($pageSize,$title,$status) {
        $return = [];
        $data = Tags::when(!empty($title),function($query) use($title) {
                return $query->where('title',$title);
        })->when($status != -1,function($query) use($status) {
                return $query->where('status',$status);
         })
         ->orderBy('created_at','desc')
         ->paginate($pageSize);
        if(!empty($data)) {
            foreach ($data ?? [] as $tag) {
                $return[] = [
                    'id' => $tag->id,
                    'title' => $tag->title,
                    'status' => $tag->status,
                    'description' => $tag->description,
                    'created_at' => $tag->created_at,
                    'updated_at' => $tag->updated_at
                ];
            }
        }
        return [$return,$data];
    }


    /**
     * @param $title
     * @param $description
     * @param $status
     * @return mixed
     * 添加标签
     */
    public function add($title,$description,$status) {
        return Tags::create([
            'title' => $title,
            'description' => $description,
            'status' => $status
        ]);
    }


    /**
     * @param $id
     * @param $title
     * @param $description
     * @param $status
     * @return mixed
     * 编辑标签
     */
    public function edit($id,$title,$description,$status) {
        return Tags::where('id',$id)->update([
            'title' => $title,
            'description' => $description,
            'status' => $status,
            'updated_at' => Carbon::now()->toDateTimeString()
        ]);
    }


    /**
     * @param $tagId
     * @param $title
     * @return mixed
     * 标签名是否存在
     */
    public function getTitleExistsExcepId($tagId,$title) {
        return Tags::where('id','!=',$tagId)->where('title',$title)->count();
    }


    /**
     * @param $adminId
     * @return mixed
     * 更改状态值
     */
    public function changeStatus($tagId) {
        $status = 0;
        $oldStatus = Tags::where('id',$tagId)->value('status');
        if(!$oldStatus) {
            $status = 1;
        }
        return Tags::where('id',$tagId)->update([
            'status' => $status,
            'updated_at' => Carbon::now()->toDateTimeString()
        ]);
    }


    /**
     * @param $id
     * @return bool
     * 删除标签数据
     */
    public function deleteData($id) {
        $result = false;
        if(is_array($id)) {
            $result = Tags::whereIn('id',$id)->delete();
        }else {
            $result = Tags::where('id',$id)->delete();
        }

        return $result;
    }



    /**
     * @param $tagsId
     * @return array
     * 获取单个标签数据
     */
    public function getOne($tagsId) {
        $return = [];
        $tag = Tags::where('id',$tagsId)->first();
        if(!empty($tag)) {
            $return = [
                'id' => $tag->id,
                'title' => $tag->title,
                'description' => $tag->description,
                'status' => $tag->status,
                'created_at' => $tag->created_at,
                'updated_at' => $tag->updated_at
            ];
        }
        return $return;
    }


    /**
     * @param $id
     * @return mixed
     * 获取标签简介
     */
    public function getDescriptionById($id) {
        return Tags::where('id',$id)->value('description');
    }


    /**
     * @return array
     * 获取所有标签
     */
    public function getAllTags() {
        $return = [];
        $data = Tags::all();
        if(!empty($data)) {
            foreach ($data ?? [] as $tag) {
                $return[] = [
                    'id' => $tag->id,
                    'title' => $tag->title,
                ];
            }
        }
        return [$return,$data];
    }
}
