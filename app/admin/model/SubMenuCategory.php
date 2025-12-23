<?php

namespace app\admin\model;

use think\response\Json;

class SubMenuCategory extends BaseM
{
     protected $json = ['items'];
     protected $jsonAssoc = true;

     public function getList($page,$limit,$where){
         $list = $this->page($page,$limit)->where($where)->order(['ranking'=>'desc','id'=>'desc'])->select();
         $total = $this->where($where)->count();
         return [
            'list'=>$list,
             'total'=>$total
         ];
     }
}