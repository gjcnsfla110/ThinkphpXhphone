<?php

namespace app\admin\model;
class GoodsReview extends BaseM
{
    public  function getImgAttr($value){
        return json_decode($value);
    }

    public function getList($page,$limit,$where){
        $list = $this->page($page,$limit)->where($where)->order('id desc')->select();
        $total = $this->where($where)->count();
        return [
           'list'=>$list,
           'total'=>$total
        ];
    }

}