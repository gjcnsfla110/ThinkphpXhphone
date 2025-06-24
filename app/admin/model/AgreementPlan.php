<?php

namespace app\admin\model;
use app\admin\model\Plan;

class AgreementPlan extends BaseM
{
     public function getList($id,$isCheck,$agreement_id){
         if($isCheck){
             $plans = Plan::where('category_id',$id)->select();
         }else{
             $plans = [];
         }
         $list = $this->where('agreement_id',$agreement_id)->select();
         return [
             'plans' => $plans,
             'list' => $list,
         ];
     }
}