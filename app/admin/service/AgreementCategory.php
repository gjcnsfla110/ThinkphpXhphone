<?php

namespace app\admin\service;

class AgreementCategory extends BaseService
{
    public function index($page,$limit){
        return $this->M->getList($page,$limit);
    }

    public function create($data){
        return $this->M->MPsave($data);
    }

    public function update($data){
        return request()->Model->save($data);
    }

    public function updateStatus($status){
        return request()->Model->save(['status'=>$status]);
    }

    public function updateHot($hot){
        return request()->Model->save(['hot'=>$hot]);
    }

    public function delete(){
        return $this->M->MPdelete();
    }
}