<?php

namespace app\admin\service;

class Rule extends BaseService
{
    public function list($page,$limit){
        return $this->M->Mlist($page,$limit);
    }

    public function addRule($data){
        return $this->M->MPsave($data);
    }

    public function updateRule($id,$data){
        return $this->M->Mupdate($id,$data);
    }

    public function updateStatus($id,$status){
        return $this->M->MupdateStatus($id,$status);
    }

    public function deleteRule($id){
        return $this->M->MPdelereOne(['id'=>$id]);
    }
}