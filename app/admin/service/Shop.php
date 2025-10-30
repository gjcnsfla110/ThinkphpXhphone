<?php

namespace app\admin\service;

class Shop extends BaseService
{
    public function index($param){
        $page = $param['page'] ? $param['page'] : 1;
        $limit = $param['limit'] ? $param['limit'] : 10;
        return $this->M->getList($page,$limit);
    }
    public function add($data){
        return $this->M->MPsave($data);
    }

    public function update($data){
        return request()->Model->save($data);
    }
    public function updateShopImg($shopImg){
        return request()->Model->save(['shopImg'=>$shopImg]);
    }

    public function delete(){
        return $this->M->MPdelete();
    }

    public function updateStatus($status){
        return request()->Model->save(['status'=>$status]);
    }
}