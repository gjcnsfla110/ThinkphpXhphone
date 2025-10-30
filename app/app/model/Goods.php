<?php

namespace app\app\model;

class Goods extends BaseM
{
    public function getSubMenuList($id,$page = 1,$limit = 10){
        $list = $this->where(['sideCategory_id'=>$id])->page($page,$limit)->order(['order'=>'desc','id'=>'desc'])->select();
        $total = $this->where(['sideCategory_id'=>$id])->count();
        return [
            'list'=>$list,'total'=>$total
        ];
    }
}