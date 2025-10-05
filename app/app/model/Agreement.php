<?php

namespace app\app\model;
use app\admin\model\AgreementCategory;
use app\admin\model\AgreementPlan;
use app\admin\model\CreditCard;
class Agreement extends BaseM
{
    public function getAgreementList(){
        $agreementCategory = AgreementCategory::order(['ranking'=>'desc','id'=>'desc'])->select();
        $agreementList = $this->order(['ranking'=>'desc','id'=>'desc'])->select();
        $cardSales = CreditCard::select();
        return [
            'category' => $agreementCategory,
            'agreementList' => $agreementList,
            'cardSales' => $cardSales
        ];
    }

    public function ActiveCategoryList($id){
        $list = $this->where(['category_id'=>$id])->order(['ranking'=>'desc','id'=>'desc'])->select();
    }

    public function getPlans($id){
        $plans = AgreementPlan::where(['agreement_id'=>$id])->order(['ranking'=>'desc','id'=>'desc'])->select();
        return [
            'plans' => $plans
        ];
    }
}