<?php

namespace app\admin\model;
use app\admin\model\ShopCategory;
class Shop extends BaseM
{
    public function getList($page, $limit=10){
        $categorys = ShopCategory::where('status',1)->select();
        $list = $this->page($page,$limit)->where(['status'=>1])->order(['id'=>'desc'])->select();
        $total = $this->count();
        return [
            'categorys'=>$categorys,
            'list'=>$list,
            'total' => $total
        ];
    }
}