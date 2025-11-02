<?php

namespace app\app\model;

class Accessories extends BaseM
{
    public function getSubCategoryList($id,$page = 1,$limit = 10){
        $list = $this->where(['sideCategory_id'=>$id])->page($page,$limit)->order(['ranking'=>'desc','id'=>'desc'])->select();
        $total = $this->where(['sideCategory_id'=>$id])->count();
        return [
            'list'=>$list,
            'total'=>$total
        ];
    }
}