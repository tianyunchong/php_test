<?php
/**
 * mongodb的基类
 * User: zyh
 * Date: 17/3/30
 * Time: 上午8:46
 */

/**
 * Class MongoDbBase
 */
class MongoDbBase {
    protected $conn;
    protected $readConn;
    private $mongoConfig = array(
        "192.168.8.189", "27017"
    );
    public function __construct()
    {
        $this->init();
        $this->connectMongo();
        $this->getReadConn();
    }

    /**
     * 一些初始化的功能
     * @return null
     */
    public function init() {
        //pass
    }

    /**
     * 重设置下mongo配置
     * @param $host
     * @param $port
     */
    public function setMongoConnect($host, $port) {
        $this->mongoConfig = array($host, $port);
    }

    /**
     * 实现mongodb的链接操作
     * @return null
     */
    private function connectMongo() {
        $host = $this->mongoConfig[0];
        $port = $this->mongoConfig[1];
        try {
            $this->conn = new \MongoDB\Driver\Manager("mongodb://{$host}:{$port}");
        } catch (Exception $e) {
            exit("mongodb连接失败!");
        }
    }

    /**
     * 获取下读链接
     * @return null
     */
    private function getReadConn() {
        $this->readConn = $this->conn->getReadConcern();
    }
}