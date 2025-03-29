<?php

namespace app\admin\model;

class Brand extends BaseM
{
    public function getAll(){
        $list = $this->select()->toArray();
        $total = $this->count();
        return [
            'total' => $total,
            'list' => $list
        ];
    }
}