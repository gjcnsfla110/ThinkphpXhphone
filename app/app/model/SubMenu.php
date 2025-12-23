<?php

namespace app\app\model;
use app\admin\model\SubMenuCategory;
class SubMenu extends BaseM
{
    public function getSubMenuCategory($categoryId){
        $list = SubMenuCategory::where('id',$categoryId)->select();
        return [
            'list'=>$list
        ];
    }
}