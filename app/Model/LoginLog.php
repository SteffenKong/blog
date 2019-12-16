<?php

namespace App\Model;

use App\Tools\Loader;
use App\Tools\MongoDB;

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
    public function getList() {
        $return = [];
        $data = $this->mongoDB->query([],[],$this->collectionName);
        foreach ($data ?? [] as $log) {
            $return[] = [
                'id' => $log->id,
                'account' => $log->account,
                'params' => $log->params,
                'loginType' => $log->loginType
            ];
        }
        return $return;
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
            'account' => $account
        ],$this->collectionName);
    }
}
