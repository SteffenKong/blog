<?php

namespace App\Model;

use App\Tools\Loader;
use App\Tools\MongoDB;
use Carbon\Carbon;

/**
 * Class LoginLog
 * @package App\Model
 * 登录日志
 */
class LoginLog {

    /* @var MongoDB $mongoDB */
    protected $mongoDB;

    protected $collectionName = 'loginLog';

    public function __construct() {
        $this->mongoDB = Loader::singleton(MongoDB::class);
    }


    /**
     * @return array
     * @throws \MongoDB\Driver\Exception\Exception
     */
    public function getList($page,$pageSize) {
        $return = [];
        $data = $this->mongoDB->query([],['skip'=>$page,'limit'=>$pageSize],$this->collectionName);
        foreach ($data ?? [] as $log) {
            $return[] = [
                'id' => $log->_id,
                'account' => $log->account,
                'ip' => $log->ip,
                'params' => $log->params,
                'createdAt' => $log->created_at ?? ''
            ];
        }

        $count = $this->mongoDB->count('loginLog');
        return [$return,$count];
    }


    /**
     * @param $ip
     * @param $params
     * @param $account
     * @return \MongoDB\Driver\WriteResult
     * 记录登录日志
     */
    public function addLog($ip,$params,$account) {
        return $this->mongoDB->insert([
            'ip' => $ip,
            'params' => json_encode($params),
            'account' => $account,
            'created_at' => Carbon::now()->toDateTimeString(),
        ],$this->collectionName);
    }


    /**
     * @param $logId
     * @return \MongoDB\Driver\WriteResult
     * 删除日志
     */
    public function delData($logId) {
        return $this->mongoDB->delete(['id'=>$logId],[],$this->collectionName);
    }
}
