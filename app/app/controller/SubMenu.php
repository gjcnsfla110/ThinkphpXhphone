<?php

namespace app\app\controller;

use app\common\Base;
class SubMenu extends Base
{
    protected $noneValidateCheck = ['getSubMenuList'];
    public function getSubMenuList(){
        $data = $this->serviceM->getSubMenuList();
        return showSuccess($data);
    }

    public function getSubMenuCategory(){
        $categoryId = input('categoryId');
        $data = $this->serviceM->getSubMenuCategory($categoryId);
        return showSuccess($data);
    }
}