<?php

namespace app\admin\service;

class ComponentItem extends BaseService
{
    public function index($id){
        return $this->M->getList($id);
    }

    public function create($data){
        return $this->M->MPsave($data);
    }

    public function delete(){
        return $this->M->MPdelete();
    }
    public function getGoodsList($page, $limit){
        return $this->M->getGoodsList($page, $limit);
    }
}