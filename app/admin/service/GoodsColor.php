<?php

namespace app\admin\service;

class GoodsColor extends BaseService
{
    public function index($page,$limit){
        return $this->M->getAll($page,$limit);
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