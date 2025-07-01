<?php

namespace app\admin\model;
use app\admin\model\AgreementCategory;
use app\admin\model\AgreementSideCategory;
use app\admin\model\PlanCategory;
use app\admin\model\AgreementPlan;

class Agreement extends BaseM
{
    public function getList($page,$limit,$where=[]){
        $list = $this->page($page,$limit)->where($where)->order('ranking','desc')->select();
        $count = $this->count();
        $categorys = AgreementCategory::select();
        $sideCategorys = AgreementSideCategory::select();
        $planCategorys = PlanCategory::select();
        return [
            "list"=>$list,
            "total"=>$count,
            "categorys"=>$categorys,
            "sideCategorys"=>$sideCategorys,
            "planCategorys"=>$planCategorys,
        ];
    }

    public function detail($id){
        $detail = $this->where(['id'=>$id])->select();
        $plans = AgreementPlan::where('agreement_id',$id)->select();
        return [
            'item'=>$detail,
            'plans'=>$plans,
        ];
    }
}