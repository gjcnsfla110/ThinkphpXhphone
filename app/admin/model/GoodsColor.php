<?php

namespace app\admin\model;

class GoodsColor extends BaseM
{
    public function getAll($page,$limit){
        $list = $this->page($page,$limit)->select();
        $total = $this->count();
        return ['list'=>$list,'total'=>$total];
    }
}