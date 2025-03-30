<?php

namespace app\admin\model;

class Label extends BaseM
{
    public function getAll($page,$limit = 10){
        $list = $this->page($page,$limit)->select();
        $total = $this->count();
        return [
            'list' => $list,
            'total' => $total
        ];
    }
}