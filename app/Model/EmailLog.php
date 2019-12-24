<?php

namespace App\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class EmailLog extends Model
{
    protected $table = 'email_log';
    protected $primaryKey = 'id';
    public $fillable = [

    ];


    /**
     * @param $pageSize
     * @return array
     * 获取列表
     */
    public function getList($pageSize) {
        $return = [];
        $data = EmailLog::orderBy('created_at','desc')->paginate($pageSize);
        if($data) {
            foreach ($data ?? [] as $emailLog) {
                $return[] = [
                    'id' => $emailLog->id,
                    'fromUser' => $emailLog->fromUser,
                    'recvUser' => $emailLog->recvUser,
                    'content' => $emailLog->content,
                    'status' => $emailLog->status,
                    'createdAt' => $emailLog->created_at,
                    'updatedAt' => $emailLog->updated_at
                ];
            }
        }
        return [$return,$data];
    }

    /**
     * @param $logId
     * @return mixed
     * 删除日志
     */
    public function delData($logId) {
        return EmailLog::where('id',$logId)->delete();
    }


    /**
     * @param $title
     * @param $fromUser
     * @param $recvUser
     * @param $content
     * @param $status
     * @return mixed
     * 添加邮箱日志
     */
    public function addEmailLog($title,$fromUser,$recvUser,$content,$status) {
        return EmailLog::create([
            'title' => $title,
            'fromUser' => $fromUser,
            'recvUser' => $recvUser,
            'content' => $content,
            'status' => $status,
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString()
        ]);
    }
}
