<?php

namespace app\admin\service;

class goodsCategory extends BaseService
{
    public function list($page,$limit){
        return $this->M->getAll($page,$limit);
    }
    public function add($data){
        return $this->M->MPsave($data);
    }

    public function update($data){
        return request()->Model->save($data);
    }

    public function updateStatus($status){
        return $this->M->MPupdateStatus(['status'=>$status]);
    }

    public function delete(){
        return $this->M->MPdelete();
    }
}