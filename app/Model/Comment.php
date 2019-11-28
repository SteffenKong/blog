<?php

namespace App\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Comment
 * @package App\Model
 * 评论模型器
 */
class Comment extends Model {

    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $table = 'comment';
    protected $fillable = [
        'id',
        'username',
        'email',
        'pid',
        'content',
        'is_verify',
        'verify_time',
        'created_at',
        'updated_at'
    ];


    /**
     * @param $pageSize
     * @param $userName
     * @param $email
     * @param $isVerify
     * @return array
     * 评论列表
     */
    public function getListByAdmin($pageSize,$userName,$email,$isVerify) {
        $return = [];
        $data = Comment::when(!empty($userName),function($query) use($userName) {
            return $query->where('username','like','%'.$userName.'%');
        })->when(!empty($email),function($query) use($email) {
            return $query->where('email','like','%'.$email.'%');
        })->when($isVerify != -1,function($query) use($isVerify) {
            return $query->where('is_verify',$isVerify);
        })->orderBy('id','desc')->paginate($pageSize);

        if(!empty($data)) {
            foreach ($data ?? [] as $comment) {
                $return[] = [
                    'id' => $comment->id,
                    'userName' => $comment->username,
                    'content' => $comment->content,
                    'email' => $comment->email,
                    'pid' => $comment->pid,
                    'isVerify' => $comment->is_verify,
                    'verifyTime' => $comment->verify_time,
                    'created_at' => $comment->created_at,
                    'updated_at' => $comment->updated_at
                ];
            }
        }
        return [$return,$data];
    }


    /**
     * @param $userName
     * @param $email
     * @param $pid
     * @param $content
     * @param $isVerify
     * @return mixed
     * 添加评论
     */
    public function add($userName,$email,$pid,$content,$isVerify) {
        return Comment::create([
            'username' => $userName,
            'email' => $email,
            'pid' => $pid,
            'content' => $content,
            'isVerify' => $isVerify,
        ]);
    }


    /**
     * @param $commentId
     * @param $val
     * @return mixed
     * 评论审核
     */
    public function verify($commentId,$val) {
        return Comment::where('id',$commentId)->update([
            'is_verify'=>$val,
            'verify_time'=>Carbon::now()->toDateTimeString(),
            'updated_at'=>Carbon::now()->toDateTimeString()
        ]);
    }


    /**
     * @param $commentId
     * @return mixed
     * 删除评论
     */
    public function deleteData($commentId) {
        return Comment::where('id',$commentId)->delete();
    }
}
