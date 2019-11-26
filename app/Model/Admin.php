<?php

namespace App\Model;

use App\Tools\Rsa\Rsa;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

/**
 * Class Admin
 * @package App\Model
 */
class Admin extends Model
{

    protected $table = 'admin';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'account',
        'password',
        'email',
        'status',
        'image',
        'phone',
        'last_login_ip',
        'last_login_time',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [
        'password'
    ];

    public $timestamps = true;


    /**
     * @param $account
     * @param $password
     * @return array|bool
     * 登录状态
     */
    public function login($account,$password) {
        $rsa = new Rsa();
        $rsa->setPrivateKey(\config('blog.admin.privateKey'));
        $pass = $rsa->decrpytByPrivateKey($password);

        $admin = Admin::where('account',$account)->first();

        //用户不存在
        if(!$admin) {
            return false;
        }

        //登录失败
        if(!Hash::check($pass,$admin->password)) {
            return false;
        }

        if(Hash::needsRehash($admin->password)) {
            $hashPass = Hash::make($pass);
            Admin::where('id',$admin->id)->update([
                'password'=>$hashPass
            ]);
        }

        return [
            'id' => $admin->id,
            'account'=>$admin->account,
            'email' => $admin->email,
            'phone' => $admin->phone,
            'lastLoginIp' => $admin->last_login_ip,
            'lastLoginTime' => $admin->last_login_time
        ];
    }


    /**
     * @param $id
     * @return mixed
     * 获取用户激活状态
     */
    public function checkStatus($id) {
        return Admin::where('id',$id)->value('status');
    }


    /**
     * @param $account
     * @param $password
     * @param $email
     * @param $phone
     * @param $status
     * @param $image
     * @return mixed
     * 增加管理员
     */
    public function add($account,$password,$email,$phone,$status,$image) {
        //密码解密
        $rsa = new Rsa();
        $rsa->setPrivateKey(\config('blog.admin.privateKey'));
        $password = $rsa->decrpytByPrivateKey($password);

        return Admin::create([
            'account' => $account,
            'password' => Hash::make($password),
            'email' => $email,
            'phone' => $phone,
            'status' => $status,
            'last_login_ip' => '',
            'image' => $image
        ]);
    }


    /**
     * @param $adminId
     * @return mixed
     * 更改状态值
     */
    public function changeStatus($adminId) {
        $status = 0;
        $oldStatus = Admin::where('id',$adminId)->value('status');
        if(!$oldStatus) {
            $status = 1;
        }
        return Admin::where('id',$adminId)->update([
            'status' => $status,
            'updated_at' => Carbon::now()->toDateTimeString()
        ]);
    }

    /**
     * @param $adminId
     * @return bool|null
     */
    public function deleteData($adminId) {
        return Admin::where('id',$adminId)->delete();
    }


    /**
     * @param $pageSize
     * @param $account
     * @param $email
     * @param $phone
     * @param $status
     * @return array
     * 获取管理员列表
     */
    public function getList($pageSize, $account, $email, $phone,$status) {
        $data = Admin::when(!empty($account),function($query) use($account) {
            return $query->where('account','like','%'.$account.'%');
        })
        ->when(!empty($email),function($query) use($email) {
            return $query->where('email','like','%'.$email.'%');
        })
        ->when(!empty($phone),function($query) use($phone) {
            return $query->where('phone','like','%'.$phone.'%');
        })
        ->when($status != -1,function($query) use($status) {
                return $query->where('status',$status);
        })
        ->orderBy('created_at','desc')
        ->paginate($pageSize);
        $return = [];
        if(!empty($data)) {
            foreach ($data ?? [] as $key=>$value) {
                $return[] = [
                    'id'=>$value->id,
                    'account'=>$value->account,
                    'email'=>$value->email,
                    'phone'=>$value->phone,
                    'status'=>$value->status,
                    'lastLoginIp'=>$value->last_login_ip,
                    'lastLoginTime'=>$value->last_login_time,
                    'created_at'=>$value->created_at,
                    'updated_at'=>$value->updated_at
                ];
            }
        }
        return [$return,$data];
    }


    /**
     * @param $adminId
     * @param $account
     * @param $password
     * @param $email
     * @param $phone
     * @param $status
     * @param $image
     * @return mixed
     * 编辑管理员
     */
    public function edit($adminId,$account,$password,$email,$phone,$status,$image) {
        if(empty($password)) {
            //获取旧密码
            $password = Admin::where('id',$adminId)->value('password');
        }else {
            //密码解密
            $rsa = new Rsa();
            $rsa->setPrivateKey(\config('blog.admin.privateKey'));
            $password = $rsa->decrpytByPrivateKey($password);
            $password = Hash::make($password);
        }


        return Admin::where('id',$adminId)->update([
            'account' => $account,
            'password' => $password,
            'email' => $email,
            'phone' => $phone,
            'status' => $status,
            'last_login_ip' => '',
            'image' => $image
        ]);
    }


    /**
     * @param $adminId
     * @param $lastLoginIp
     * @param $lastLoginTime
     * @return mixed
     * 设置管理员登录日志
     */
    public function setLog($adminId,$lastLoginIp,$lastLoginTime) {
        return Admin::where('id',$adminId)->update([
            'last_login_ip' => $lastLoginIp,
            'last_login_time' => $lastLoginTime
        ]);
    }


    /**
     * @param $adminId
     * @return array
     * 获取单个管理员信息
     */
    public function getOne($adminId) {
        $return = [];
        $admin = Admin::where('id',$adminId)->first();
        if(!empty($adminId)) {
            $return = [
                'id' => $admin->id,
                'account' => $admin->account,
                'email' => $admin->email,
                'phone' => $admin->phone,
                'status' => $admin->status
            ];
        }
        return $return;
    }


    /**
     * @param $adminId
     * @param $columnName
     * @param $value
     * @return mixed
     * 判断编辑时是否有重复数据
     */
    public function getColumnIsExistsExceptAdminId($adminId,$columnName,$value) {
        return Admin::where('id','!=',$adminId)->where($columnName,$value)->count();
    }
}
