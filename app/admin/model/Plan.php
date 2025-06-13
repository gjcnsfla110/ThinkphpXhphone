<?php

namespace app\admin\model;
use app\admin\model\PlanCategory;

class Plan extends BaseM
{
     public function getPlanList($page, $limit,$where){
         $list = $this->page($page, $limit)->where($where)->select();
         $count = $this->where($where)->count();
         $categorys = PlanCategory::select();
         return [
            'list'=>$list,
            'total'=>$count,
            'categorys'=>$categorys
         ];
     }
}