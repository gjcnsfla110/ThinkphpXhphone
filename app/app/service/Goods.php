<?php

namespace app\app\service;

class Goods extends BaseService
{
    public function getOneGoods($page,$limit,$id,$type){
        return $this->M->getOneGoods($page,$limit,$id);
    }

    public function getSubMenuList($id, $page, $limit){
        return $this->M->getSubMenuList($id, $page, $limit);
    }
}