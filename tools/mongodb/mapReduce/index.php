<?php
/**
 * 测试下使用
 * User: zyh
 * Date: 17/3/30
 * Time: 上午9:20
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
        //var_dump(get_class_methods($this->readConn));
        exit;
    }
}
$map = ' 
     function() { 
      var key = {to_user:this.to_user,feed_type:this.feed_type}; 
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
$query = null;
$obj = new MapReduce();
$obj->testMapReduce($map, $reduce);