<?php

namespace App\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Message
 * @package App\Model
 * 公告模型
 */
class Message extends Model {

    protected $table = 'message';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'title',
        'content',
        'status',
        'created_at',
        'updated_at',
    ];


    /**
     * @param $pageSize
     * @param $where
     * @return array
     * 获取公告列表
     */
    public function getList($pageSize,$where) {
        $return = [];
        $data = Message::when($where['status'] != -1,function($query) use($where) {
            return $query->where('status',$where['status']);
        })->when(!empty($where['title']),function($query) use ($where) {
            return $query->where('title','like','%'.$where['title'].'%');
        })->orderBy('created_at','desc')->paginate($pageSize);
        if($data) {
            foreach ($data ?? [] as $message) {
                $return[] = [
                    'id' => $message->id,
                    'title' => $message->title,
                    'createdAt' => $message->created_at,
                    'updatedAt' => $message->updated_at
                ];
            }
        }
        return [$data,$return];
    }


    /**
     * @param $title
     * @param $content
     * @param $status
     * @return mixed
     * 添加公告
     */
    public function add($title,$content,$status) {
        return Message::create([
            'title' => $title,
            'content' => $content,
            'status' => $status,
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString()
        ]);
    }


    /**
     * @param $messageId
     * @param $title
     * @param $content
     * @param $status
     * @return mixed
     * 编辑公告
     */
    public function edit($messageId,$title,$content,$status) {
        return Message::where('id',$messageId)->update([
            'title' => $title,
            'content' => $content,
            'status' => $status,
            'updated_at' => Carbon::now()->toDateTimeString()
        ]);
    }


    /**
     * @param $messageId
     * @return mixed
     * 删除公告
     */
    public function delData($messageId) {
        return Message::where('id',$messageId)->delete();
    }


    /**
     * @param $messageId
     * @return mixed
     * 编辑状态
     */
    public function changeStatus($messageId) {
        $status = 0;
        $oldStatus = Message::where('id',$messageId)->value('status');
        if(!$oldStatus) {
            $status = 1;
        }
        return Message::where('id',$messageId)->update(['status'=>$status,'updated_at'=>Carbon::now()->toDateTimeString()]);
    }
}
