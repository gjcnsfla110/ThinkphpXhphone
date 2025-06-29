<?php

namespace app\admin\service;

class AgreementPlan extends BaseService
{
    public function index($id,$isCheck,$agreement_id){
        return $this->M->getList($id,$isCheck,$agreement_id);
    }

    public function create($data){
        return $this->M->create($data);
    }

    public function update($data){
        return request()->Model->save($data);
    }

    public function delete(){
        $this->M->MPdelete();
    }
}