<?php

namespace app\admin\model;

class Service extends BaseM
{
    public function getAll($page,$limit=10){
        $list = $this->select();
        $total = $this->count();
        return [
            'list'=>$list,
            'total'=>$total,
        ];
    }
}