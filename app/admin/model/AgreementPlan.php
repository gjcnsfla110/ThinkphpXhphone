<?php

namespace app\admin\model;
use app\admin\model\Plan;

class AgreementPlan extends BaseM
{
     public function getList($id,$isCheck,$agreement_id){
         if((int)$isCheck){
             $plans = Plan::where('category_id',$id)->select();
             $list = $this->where('agreement_id',$agreement_id)->select();
             return [
                 'plans' => $plans,
                 'list' => $list,
             ];
         }else{
             $list = $this->where('agreement_id',$agreement_id)->select();
             return [
                 'list' => $list,
             ];
         }
     }
}