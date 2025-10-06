<?php

namespace app\admin\model;
use app\admin\model\GoodsColor;
class Label extends BaseM
{
    public function getAll($page,$limit = 10){
        $list = $this->page($page,$limit)->select();
        $total = $this->count();
        $colors = GoodsColor::select();
        return [
            'list' => $list,
            'total' => $total,
            'colors' => $colors,
        ];
    }
}