<?php

namespace app\app\controller;

use app\common\Base;

class Goods extends Base
{
    protected $noneValidateCheck = ['getSubMenuList'];
     public function getOneGoods(){
         $id = input('id');
         $page = input('page');
         $limit = input('limit');
         $type = input('type');
         $data = $this->serviceM->getOneGoods($page,$limit,$id,$type);
         return showSuccess($data);
     }

     public function getSubMenuList(){
         $id = input('subMenuId');
         $page = input('page');
         $limit = input('limit');
         $data = $this->serviceM->getSubMenuList($id, $page, $limit);
         return showSuccess($data);
     }
}