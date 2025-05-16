<?php

namespace app\admin\model;
use app\admin\model\UsimCategory;
class Usim extends Model
{
    public function getUsimList($page,$limit,$where,$isCheck){
        if($isCheck < 2){
            $category =UsimCategory::select();
            $list = $this->page($page,$limit)->where($where)->select();
            return [
                'category'=>$category,
                'list'=>$list
            ];
        }else{
            $list = $this->page($page,$limit)->where($where)->select();
            return [
                'list'=>$list
            ];
        }
    }
}