<?php

namespace app\admin\model;
class UsimCategory extends BaseM
{
     public function getList($page,$limit){
           $categoryS = $this->page($page,$limit)->order(['ranking'=>'desc','id'=>'desc'])->where('pid',0)->select();
           $total = $categoryS->count();
           $list = $this->select()->toArray();
           return [
              'category'=>$categoryS,
              'total'=>$total,
              'list'=>$list
           ];
     }

}