<?php

namespace app\admin\model;
class UsimCategory extends BaseM
{
     public function getList($page,$limit){
           $categoryS = $this->page($page,$limit)->where('pid',0)->order(['ranking'=>'desc','id'=>'desc'])->select();
           $total = $this->where('pid',0)->count();
           $list = $this->select()->toArray();
           return [
              'category'=>$categoryS,
              'total'=>$total,
              'list'=>$list
           ];
     }

}