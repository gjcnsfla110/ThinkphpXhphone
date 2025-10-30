<?php

namespace app\app\model;
use app\admin\model\ShopCategory;
class Shop extends BaseM
{
    public function getShopList(){
        $category = ShopCategory::where('status',1)->select();
        $list = $this->where('status',1)->select();
        return [
            'category' => $category,
            'list' => $list
        ];
    }
}