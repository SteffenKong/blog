<?php

namespace App\Model;

use App\Tools\Loader;
use App\Tools\MongoDB;
use Carbon\Carbon;
use Session;

/**
 * Class AdminLog
 * @package App\Model
 */
class AdminLog
{

    protected $collection = "adminLog";

    /* @var MongoDB $mongodb */
    protected $mongodb;

    public function __construct() {
        $this->mongodb = Loader::singleton(MongoDB::class);
    }


    /**
     * @return array
     * @throws \MongoDB\Driver\Exception\Exception
     */
    public function getList() {
        $return = [];
        $data = $this->mongodb->query([],[],$this->collection);
        foreach ($data ?? [] as $log) {
            $return[] = [
                'id' => $log->_id,
                'account' => $log->account,
                'router' => $log->router,
                'ip' => $log->ip,
                'method' => $log->method,
                'params' => $log->params,
                'createdAt' => $log->created_at
            ];
        }
        return $return;
    }


    /**
     * @param $account
     * @param $method
     * @param array $params
     * @param $router
     * @param $ip
     * @return \MongoDB\Driver\WriteResult
     * 记录日志
     */
    public function addLog($account,$method,array $params = [],$router,$ip) {
        return $this->mongodb->insert([
            'account'=>Session::get('admin')['account'],
            'router'=>$router,
            'ip'=>$ip,
            'method' => $method,
            'params' => json_encode($params),
            'created_at' => Carbon::now()->toDateTimeString()
        ],$this->collection);
    }
}
