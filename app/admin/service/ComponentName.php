<?php

namespace app\admin\service;

class ComponentName extends BaseService
{
    public function index($page, $limit){
        return $this->M->getList($page, $limit);
    }

    public function create($data){
        return $this->M->MPsave($data);
    }

    public function update($data){
        return $this->M->MPupdate($data);
    }

    public function delete(){
        return $this->M->MPdelete();
    }
}