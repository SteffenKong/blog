<?php

namespace App\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Banner
 * @package App\Model
 * 横幅模型器
 */
class Banner extends Model {

    protected $table = 'banner';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'title',
        'image',
        'status',
        'created_at',
        'updated_at'
    ];


    /**
     * @param $pageSize
     * @param $title
     * @param $status
     * @return array
     * 获取横幅列表
     */
    public function getListByAdmin($pageSize,$title,$status) {
        $return = [];
        $data = Banner::when(!empty($title),function($query) use ($title) {
            return $query->where('title','like','%'.$title.'%');
        })->when($status != -1,function($query) use ($status) {
            return $query->where('status',$status);
        })->orderBy('id','desc')->paginate($pageSize);
        if (!empty($data)) {
            foreach ($data ?? [] as $banner) {
                $return[] = [
                    'id' => $banner->id,
                    'title' => $banner->title,
                    'image' => $banner->image,
                    'status' => $banner->status,
                    'createdAt' => $banner->created_at,
                    'updatedAt' => $banner->updated_at
                ];
            }
        }
        return [$return,$data];
    }


    /**
     * @param $title
     * @param $image
     * @param $status
     * @return mixed
     * 添加横幅
     */
    public function add($title,$image,$status) {
        return Banner::create([
            'title' => $title,
            'image' => $image,
            'status' => $status
        ]);
    }


    /**
     * @param $bannerId
     * @param $title
     * @param $image
     * @param $status
     * @return mixed
     * 编辑横幅
     */
    public function edit($bannerId,$title,$image,$status) {
        return Banner::where('id',$bannerId)->update(
            [
                'title' => $title,
                'image' => $image,
                'status' => $status
            ]
        );
    }

    /**
     * @param $bannerId
     * @return mixed
     * 删除横幅
     */
    public function deleteData($bannerId) {
        return Banner::where('id',$bannerId)->delete();
    }


    /**
     * @param $bannerId
     * @return mixed
     * 更改状态
     */
    public function changeStatus($bannerId) {
        $status = 0;
        $oldStatus = Banner::where('id',$bannerId)->value('status');
        if(!$oldStatus) {
            $status = 1;
        }
        return Banner::where('id',$bannerId)->update([
            'status' => $status,
            'updated_at' => Carbon::now()->toDateTimeString()
        ]);
    }


    /**
     * @param $bannerId
     * @return array
     * 获取单个横幅
     */
    public function getOne($bannerId) {
        $return = [];
        $banner = Banner::where('id',$bannerId)->first();
        if(!empty($bannerId)) {
            $return = [
                'id' => $banner->id,
                'title' => $banner->title,
                'image' => $banner->image,
                'status' => $banner->status,
                'createdAt' => $banner->created_at,
                'updatedAt' => $banner->updated_at
            ];
        }
        return $return;
    }


    /**
     * @param $id
     * @param $title
     * @return mixed
     * 检测横幅名称是否存在(编辑时)
     */
    public function checkTitleIsExistsExcepId($id,$title) {
        return Banner::where('id','!=',$id)->where('title',$title)->count();
    }
}
