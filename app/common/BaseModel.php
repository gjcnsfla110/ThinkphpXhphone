<?php

namespace app\common;
use think\Model;

class BaseModel extends Model
{

    public function list_to_tree2($data,$field="pid",$child="child",$pid=0,$callback = null){
         if(!is_array($data))return [];
         $arr = [];
         foreach($data as $v){
             $extra = true;
             if(is_callable($callback)){
                 $extra = $callback($v);
             }
         }
         if($extra && $v[$field] == $pid){
             $v["child"] = $this->list_to_tree2($v,$field,$child,$v[$field],$callback);
             $arr = $v;
         }
         return $arr;
    }
}