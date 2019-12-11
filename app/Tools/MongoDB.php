<?php
namespace App\Tools;

use MongoDB\Driver\Manager;
use MongoDB\Driver\WriteConcern;
use MongoDB\Driver\BulkWrite;
use MongoDB\Driver\Query;

/**
 * Class MongoDB
 */
final class MongoDB {

    protected $db;
    protected $mongodb;
    protected $bulk;
    protected $writeConcern;
    protected $collection;
    protected $query;
    protected $timeOut = 1000;
    private static $instance = null;


    /**
     * @param array $config
     * @return MongoDB|null
     * @throws Exception
     */
    public static function instance(array $config) {
        return self::$instance ?? new self($config);
    }

    private function __construct(array $config) {
        $this->db = $config['db'] ?? '';
        $this->mongodb = $this->connectMongo($config);
    }


    /**
     * @param $config
     * @return Manager
     * 连接mongodb
     */
    public function connectMongo(array $config) {
        $url = "mongodb://{$config['userName']}:{$config['password']}@{$config['host']}:{$config['port']}/$this->db";
        if (!$config['userName'] || !$config['password']) {
            $url = "mongodb://{$config['host']}:{$config['port']}";
        }
        return new Manager($url);
    }



    /**
     * @param array $filter
     * @param array $queryOption
     * @param $table
     * @return \MongoDB\Driver\Cursor
     * @throws \MongoDB\Driver\Exception\Exception
     * 查询数据
     */
    public function query(array $filter = [],array $queryOption = [],$table) {
        $this->bulk = new BulkWrite();
        $this->query = new Query($filter,$queryOption);
        return $this->mongodb->executeQuery($this->db.'.'.$table,$this->query);
    }



    /**
     * @param array $documents
     * @param $table
     * @return \MongoDB\Driver\WriteResult
     * @throws MongoCursorException
     * @throws MongoCursorTimeoutException
     * @throws MongoException
     * 添加操作
     */
    public function insert(array $documents,$table){
        $this->bulk = new BulkWrite();
        $this->writeConcern = new WriteConcern(WriteConcern::MAJORITY,$this->timeOut);
        $this->bulk->insert($documents);
        return $this->mongodb->executeBulkWrite($this->db.'.'.$table,$this->bulk,$this->writeConcern);
    }


    /**
     * @param $filter
     * @param $documents
     * @param $table
     * @return \MongoDB\Driver\WriteResult
     * @throws MongoCursorException
     * 更新操作
     */
    public function update($filter,$documents,$table) {
        $this->bulk = new BulkWrite();
        $this->writeConcern = new WriteConcern(WriteConcern::MAJORITY,$this->timeOut);
        $this->bulk->update($filter,$documents);
        return $this->mongodb->executeBulkWrite($this->db.'.'.$table,$this->bulk,$this->writeConcern);
    }


    /**
     * @param $filter
     * @param array $option
     * @param $table
     * @return \MongoDB\Driver\WriteResult
     * 删除操作
     */
    public function delete($filter,array $option ,$table) {
        $this->bulk = new BulkWrite();
        $this->writeConcern = new WriteConcern(WriteConcern::MAJORITY,$this->timeOut);
        $this->bulk->delete($filter,$option);
        return $this->mongodb->executeBulkWrite($this->db.'.'.$table,$this->bulk,$this->writeConcern);
    }


    /**
     * 销毁资源
     */
    public function __destruct() {
        unset($this->bulk);
        unset($this->query);
        unset($this->writeConcern);
    }

    /**
     * 防克隆
     */
    private function __clone() {}
}

//$mongoDB = MongoDB::instance([
//    'host' => '192.168.150.133',
//    'userName' => '',
//    'password' => '',
//    'port' => 27017,
//    'db' => 'php'
//]);
