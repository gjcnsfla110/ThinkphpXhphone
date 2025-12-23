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
        $categorys = AgreementCategory::where('status',1)->select();
        $sideCategorys = AgreementSideCategory::where('status',1)->select();
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

    /**
     * @param $page
     * @param $limit
     * @param $where
     * @return array
     * 아이템을 전부보여주고 체크하여 서브메뉴 카테고리에 저장하기위해 검색하는 리스트 함수
     */
    public function checkItemsList($page,$limit,$where){
        $goodsCategory = AgreementCategory::where('status',1)->select();
        $list = $this->page($page,$limit)->where($where)->order(['ranking'=>'desc','id'=>'desc'])->select();
        $total = $this->where($where)->count();
        return [
            'mainCategory'=>$goodsCategory,
            'list'=>$list,
            'total' => $total
        ];
    }
}