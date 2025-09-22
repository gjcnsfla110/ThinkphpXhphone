<?php

namespace app\app\controller;

use app\common\Base;

class Goods extends Base
{
     public function getOneGoods(){
         $id = input('id');
         $data = $this->serviceM->getOneGoods($id);
         return showSuccess($data);
     }
}