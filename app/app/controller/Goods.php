<?php

namespace app\app\controller;

use app\common\Base;

class Goods extends Base
{
    protected $noneValidateCheck = ['getSubMenuList'];
     public function getOneGoods(){
         $id = input('id');
         $data = $this->serviceM->getOneGoods($id);
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