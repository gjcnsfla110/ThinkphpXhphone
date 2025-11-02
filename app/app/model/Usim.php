<?php

namespace app\app\model;
use app\admin\model\UsimCategory;
class Usim extends BaseM
{
    public function usimList(){
         $category = UsimCategory::where('status',1)->order(['ranking'=>'desc','id'=>'desc'])->select();
         $usims = $this->where('status',1)->order(['ranking'=>'desc','id'=>'desc'])->select();
         return [
             'category'=>$category,
             'usims'=>$usims,
         ];
    }

    public function usimDetail(){

    }
}