<?php

namespace app\app\service;

class Agreement extends BaseService
{
    public function getAgreementList(){
         return $this->M->getAgreementList();
    }

    public function ActiveCategoryList($id){
        return $this->M->ActiveCategoryList($id);
    }

    public function detailItem(){
        return request()->Model;
    }

    public function getPlans($id){
        return $this->M->getPlans($id);
    }

    public function getReviewList($id, $page, $limit){
        return $this->M->getReviewList($id, $page, $limit);
    }
}