<?php

namespace app\common;
use think\Model;

class BaseModel extends Model
{
    /**
     * 자식메뉴만들기 
     * @param $data
     * @param $field
     * @param $child
     * @param $pid
     * @param $callback
     * @return array
     */
    public function list_to_tree2($data,$field="pid",$child="child",$pid=0,$callback = null){
         if(!is_array($data))return [];
         $arr = [];
         foreach($data as $v){
             $extra = true;
             if(is_callable($callback)){
                 $extra = $callback($v);
             }
             if($extra && $v[$field] == $pid){
                 $v[$child] = $this->list_to_tree2($data,$field,$child,$v['id'],$callback);
                 $arr[] = $v;
             }
         }
         return $arr;
    }

    /**
     * 이미지클래스를 위하여 만든것 자식만 보이게하기위해서이다
     * @param $data
     * @param $field
     * @param $child
     * @param $pid
     * @param $callback
     * @return array
     */
    public function listChild($data,$field="pid",$child="child",$pid=0,$callback = null){
        if(!is_array($data))return [];
        $arr = [];
        foreach($data as $v){
            $extra = true;
            if(is_callable($callback)){
                $extra = $callback($v);
            }
            if($extra && $v[$field] == $pid){
                $v[$child] = $this->list_to_tree2($data,$field,$child,$v['id'],$callback);
                $arr[] = $v;
            }
        }
        $list = array_map(function ($item){
            $clearChild = array_map(function($child){
                if(!empty($child['child'])&&count($child['child'])>0){
                    $child['child'] = [];
                }
                return $child;
            },$item['child']);
            return array_replace($item,["child"=>$clearChild]);
        },$arr);
        array_unshift($list,[
            "id"=>0,
            "name"=>"最上级图片菜单",
            "child"=>[]
        ]);
        return $list;
    }
  
}