<?php

namespace App\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 * @package App\Model
 * 分类模型器
 */
class Category extends Model {

    protected $table = 'category';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'title',
        'pid',
        'status',
        'description',
        'created_at',
        'updated_at'
    ];


    /**
     * @return array
     * 获取排序好的分类
     */
    public function getListByAdmin() {
        $return = [];
        $data = Category::all();
        $count = Category::count();
        if(!empty($data)) {
            foreach ($data ?? [] as $category) {
                $return[] = [
                    'id' => $category->id,
                    'title' => $category->title,
                    'pid' => $category->pid,
                    'description' => $category->description,
                    'createdAt' => $category->created_at,
                    'updatedAt' => $category->updated_at
                ];
            }
        }
        $tree = getTree($return);
        return [array_reverse($tree),$count];
    }


    /**
     * @return array
     * 获取树状分类
     */
    public function getTree() {
        $return = [];
        $data = Category::all();
        if(!empty($data)) {
            foreach ($data ?? [] as $category) {
                $return[] = [
                    'id' => $category->id,
                    'title' => $category->title,
                    'pid' => $category->pid,
                    'description' => $category->description,
                    'createdAt' => $category->created_at,
                    'updatedAt' => $category->updated_at
                ];
            }
        }
        return $return;
    }


    /**
     * @param $title
     * @param $pid
     * @param $description
     * @return mixed
     * 添加分类
     */
    public function add($title,$pid,$description) {
        return Category::create([
            'title' => $title,
            'pid' => $pid,
            'description' => $description
        ]);
    }


    /**
     * @param $id
     * @param $title
     * @param $pid
     * @param $description
     * @return mixed
     * 编辑分类
     */
    public function edit($id,$title,$pid,$description) {
        return Category::where('id',$id)->update([
            'title' => $title,
            'pid' => $pid,
            'description' => $description,
            'updated_at' => Carbon::now()->toDateTimeString()
        ]);
    }


    /**
     * @param $cateId
     * @return mixed
     * 删除分类id
     */
    public function deleteData($cateId) {
        return Category::where('id',$cateId)->delete();
    }


    /**
     * @param $cateId
     * @return array
     * 获取单个分类数据
     */
    public function getOne($cateId) {
        $return = [];
        $cate = Category::where('id',$cateId)->first();
        if(!empty($cate)) {
            $return = [
                'id' => $cate->id,
                'title' => $cate->title,
                'pid' => $cate->pid,
                'description' => $cate->description,
                'createdAt' => $cate->created_at,
                'updatedAt' => $cate->updated_at

            ];
        }
        return $return;
    }


    /**
     * @param $cateId
     * @return array
     * 获取子分类节点
     */
    public function getSubChildrenIds($cateId) {
        $data = $this->getTree();
        $ids = $this->getSubIds($data,$cateId);
        return $ids;
    }


    /**
     * @param $data
     * @param $id
     * @return array
     * 获取子分类节点id
     */
    public function getSubIds($data,$id) {
        static $ids = [];
        foreach ($data ?? [] as $k=>$v) {
            if($v['pid'] == $id) {
                $ids[] = $v['id'];
                $this->getSubIds($data,$v['id']);
            }
        }
        return $ids;
    }


    /**
     * @param int $limit
     * @return array
     * 获取父级分类
     */
    public function getParentCate($limit = 10) {
        $return = [];
        $cates = Category::where('pid',0)->orderBy('created_at','desc')->limit($limit)->get();
        if(!empty($cates)) {
            foreach ($cates ?? [] as $cate) {
                $return[] = [
                    'title' => $cate->title
                ];
            }
        }
        return $return;
    }
}
