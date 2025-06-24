<?php

namespace app\admin\service;

class AgreementPlan extends BaseService
{
    public function index($id,$isCheck,$agreement_id){
        return $this->M->getList($id,$isCheck,$agreement_id);
    }

    public function create(){

    }

    public function update(){

    }

    public function delete(){

    }
}