<?php
namespace app\admin\model;

class ComponentName extends BaseM
{
     public function getList($page, $limit){
         $list = $this->page($page, $limit)->select();
         $total = $this->count();
         return [
             'list'=>$list,
             'total'=>$total
         ];
     }
}