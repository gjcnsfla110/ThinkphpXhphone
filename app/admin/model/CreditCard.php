<?php

namespace app\admin\model;

class CreditCard extends BaseM
{
    public function getList($page,$limit,$where=[]){
        $list = $this->page($page,$limit)->where($where)->select();
        $count = $this->where($where)->count();
        return [
            "list"=>$list,
            "total"=>$count,
        ];
    }
}