<?php

namespace app\app\service;

class Goods extends BaseService
{
    public function getOneGoods(){
        return request()->Model;
    }

    public function getSubMenuList($id, $page, $limit){
        return $this->M->getSubMenuList($id, $page, $limit);
    }
}