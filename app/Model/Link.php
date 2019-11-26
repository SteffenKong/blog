<?php

namespace App\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;


/**
 * Class Link
 * @package App\Model
 * 友情链接模型器
 */
class Link extends Model {
    protected $table = 'link';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'title',
        'url',
        'status',
        'sort',
        'created_at',
        'updated_at'
    ];

    public $timestamps = true;


    /**
     * @param $pageSize
     * @param $title
     * @param $url
     * @param $status
     * @return array
     * 获取友情链接列表
     */
    public function getList($pageSize,$title,$url,$status) {
        $return = [];
        $data = Link::when(!empty($title),function($query) use($title) {
            return $query->where('title','like','%'.$title.'%');
        })
        ->when(!empty($url),function($query) use($url) {
            return $query->where('url','like','%'.$url.'%');
        })
        ->when($status != -1,function($query) use($status) {
            return $query->where('status',$status);
        })
        ->orderBy('created_at','desc')
        ->paginate($pageSize);

        if(!empty($data)) {
            foreach ($data ?? [] as $link) {
                $return[] = [
                    'id' => $link->id,
                    'title' => $link->title,
                    'url' => $link->url,
                    'status' => $link->status,
                    'sort' => $link->sort,
                    'createdAt' => $link->created_at,
                    'updatedAt' => $link->updated_at
                ];
            }
        }
        return [$return,$data];
    }


    /**
     * @param $title
     * @param $url
     * @param $status
     * @return mixed
     * 添加友情链接
     */
    public function add($title,$url,$status) {
        return Link::create([
            'title' => $title,
            'url' => $url,
            'status' => 1,
            'sort' => 0
        ]);
    }


    /**
     * @param $id
     * @param $title
     * @param $url
     * @param $status
     * @return mixed
     * 编辑友情链接
     */
    public function edit($id,$title,$url,$status) {
        return Link::where('id',$id)->update([
            'title' => $title,
            'url'=> $url,
            'status' => $status,
            'updated_at' => Carbon::now()->toDateTimeString()
        ]);
    }


    /**
     * @param $adminId
     * @return mixed
     * 更改状态值
     */
    public function changeStatus($linkId) {
        $status = 0;
        $oldStatus = Link::where('id',$linkId)->value('status');
        if(!$oldStatus) {
            $status = 1;
        }
        return Link::where('id',$linkId)->update([
            'status' => $status,
            'updated_at' => Carbon::now()->toDateTimeString()
        ]);
    }


    /**
     * @param $id
     * @return mixed
     * 删除友情链接
     */
    public function deleteData($id) {
        return Link::where('id',$id)->delete();
    }



    /**
     * @param $id
     * @param $url
     * @return mixed
     * 获取url是否存在
     */
    public function getTitleIsExistsExceptId($id,$title) {
        return Link::where('id','!=',$id)->where('title',$title)->count();
    }


    /**
     * @param $id
     * @param $url
     * @return mixed
     * 获取url是否存在
     */
    public function getUrlIsExistsExceptId($id,$url) {
        return Link::where('id','!=',$id)->where('url',$url)->count();
    }


    /**
     * @param $cateId
     * @return array
     * 获取单个友情链接数据
     */
    public function getOne($cateId) {
        $return = [];
        $link = Link::where('id',$cateId)->first();
        if(!empty($link)) {
            $return = [
                'id' => $link->id,
                'title' => $link->title,
                'url' => $link->url,
                'status' => $link->status,
                'createdAt' => $link->created_at,
                'updatedAt' => $link->updated_at

            ];
        }
        return $return;
    }
}
