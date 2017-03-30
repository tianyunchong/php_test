<?php
/**
 * 聚合后计数操作
 * User: zyh
 * Date: 17/3/30
 * Time: 下午3:44
 */
include "../common.php";
include ROOT."/Base.php";
class AggregateMongo extends MongoDbBase {
    /**
     * 初始化运行
     * @return null
     */
    public function init() {
        $this->setMongoConnect("192.168.8.189", "27017");
    }

    /**
     * 测试下聚合操作
     * @return null
     */
    public function test() {
        $options = array(
            array('$group' => array('_id' => '$name', "totalCount" => array('$sum' => 1))),
        );
        $command = new \MongoDB\Driver\Command(array(
            "aggregate" => "test",//聚合的表名
            "pipeline"  => $options,
            'cursor' => new stdClass,
        ));
        try {
            $cursor = $this->conn->executeCommand("demo", $command);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        if (isset($cursor) && $cursor) {
            var_dump($cursor->toArray());
        }
    }
}

$object = new AggregateMongo();
$object->test();