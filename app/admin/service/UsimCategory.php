<?php

namespace app\admin\service;

class UsimCategory extends BaseService
{
    public function index($page,$limit){
         return $this->M->getList($page,$limit);
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

    public function updateStatus($status){
        return request()->Model->save(['status'=>$status]);
    }

    public function updateHot($hot){
        return request()->Model->save(['hot'=>$hot]);
    }
}