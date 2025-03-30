<?php

namespace app\admin\service;

class Delivery extends BaseService
{
    public function index($data){
        return $this->M->getAll($data);
    }

    public function add($data){
        return $this->M->MPsave($data);
    }

    public function update($data){
        return request()->Model->save($data);
    }

    public function delete(){
        return $this->M->MPdelete();
    }
}