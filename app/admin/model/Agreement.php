<?php

namespace app\admin\model;
use app\admin\model\AgreementCategory;
use app\admin\model\AgreementSideCategory;

class Agreement extends BaseM
{
    public function getList($page,$limit,$where=[]){
        $list = $this->page($page,$limit)->where($where)->order('ranking','desc')->select();
        $count = $this->count();
        $categorys = AgreementCategory::select();
        $sideCategorys = AgreementSideCategory::select();
        return [
            "list"=>$list,
            "total"=>$count,
            "categorys"=>$categorys,
            "sideCategorys"=>$sideCategorys,
        ];
    }
}