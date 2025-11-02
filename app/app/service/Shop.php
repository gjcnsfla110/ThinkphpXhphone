<?php

namespace app\app\service;

class Shop extends BaseService
{
    public function getShopList(){
        return $this->M->getShopList();
    }

    public function getShopDate(){
        return request()->Model();
    }
}