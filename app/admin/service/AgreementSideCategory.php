<?php

namespace app\admin\service;

class AgreementSideCategory extends BaseService
{
    public function index($page, $limit =10){
        return $this->M->getSideCategoryList($page, $limit);
    }

    public function create($data){
         return $this->M->MPsave($data);
    }

    public function update($data){
        return request()->Model->save($data);
    }

    public function delete(){
        return request()->delete();
    }

    public function updateStatus($status){
        return request()->Model->save('status',$status);
    }
}