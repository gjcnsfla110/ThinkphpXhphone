<?php

namespace app\admin\model;
use app\admin\model\Plan;

class AgreementPlan extends BaseM
{
     public function getList($id){
         $plans = Plan::where('category_id',$id)->select();
         return [
             'list' => $plans,
         ];
     }
}