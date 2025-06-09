<?php

namespace app\admin\service;

class SubMenu extends BaseService
{
    public function index($page,$limit){
        return $this->M->getlist($page,$limit);
    }

    public function create($data){
        return $this->M->MPsave($data);
    }

    public function update($data){
        return request()->Model->save($data);
    }

    public function delete(){
        return $this->M->MPdelete();
    }

    public function updateStatus($status){
        return request()->Model->save(['status'=>$status]);
    }
}