<?php

namespace app\app\service;

class SubMenu extends BaseService
{
    public function getSubMenuList(){
        return $this->M->select();
    }

    public function getSubMenuCategory($categoryId){
        return $this->M->getSubMenuCategory($categoryId);
    }
}