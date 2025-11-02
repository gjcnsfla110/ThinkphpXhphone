<?php

namespace app\app\controller;

use app\common\Base;

class Shop extends Base
{
    protected $noneValidateCheck = ['getShopList'];
    public function getShopList(){
        $data = $this->serviceM->getShopList();
        return showSuccess($data);
    }

    public function getShopDate(){
        $data = $this->serviceM->getShopDate();
        return showSuccess($data);
    }
}