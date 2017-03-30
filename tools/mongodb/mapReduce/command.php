<?php
/**
 * command方式执行mapreduce
 * User: zyh
 * Date: 17/3/30
 * Time: 下午3:04
 */
include "../common.php";
include ROOT."/Base.php";
class MapReduce extends MongoDbBase {
    public function init()
    {
        $this->setMongoConnect("192.168.8.189", 27017);
    }

    /**
     * 测试下map_reduce功能
     * @param $map
     * @param $reduce
     * @return null
     */
    public function testMapReduce($map, $reduce) {
        $map     = new \MongoDB\BSON\Javascript($map);
        $reduce  = new \MongoDB\BSON\Javascript($reduce);
        $query   = null;
        $command = new \MongoDB\Driver\Command(array(
            "mapreduce" => "test",//表名
            "map"       => $map,
            "reduce"    => $reduce,
            "query"     => $query,
            "out"       => array("replace" => "testCounts"),//输出结果将被插入到一个集合中，并且会自动替换掉现有的同名集合
        ));
        try {
            $cursor = $this->conn->executeCommand("demo", $command);
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
        var_dump($cursor);
        exit;
    }
}
$map = ' 
     function() { 
      var key = {name:this.name}; 
      var value = {count:1}; 
      emit(key,value); 
    } ';
$reduce = ' 
     function(key, values) { 
         var ret = {count:0}; 
     for(var i in values) { 
          ret.count += 1; 
      } 
      return ret; 
      }';
$obj = new MapReduce();
$obj->testMapReduce($map, $reduce);