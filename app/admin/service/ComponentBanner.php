<?php

namespace app\admin\service;

class ComponentBanner extends BaseService
{
    public function index($component_id){
        return $this->M->getList($component_id);
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

    public function getGoodsItem($id){
        return $this->M->getGoodsItem($id);
    }

    public function getAgreementItem($id){
        return $this->M->getAgreementItem($id);
    }

    public function getUsimItem($id){
        return $this->M->getUsimItem($id);
    }

    public function getAccessoriesItem($id){
        return $this->M->getAccessoriesItem($id);
    }
    public function getCategoryItem($id){
        return $this->M->getCategoryItem($id);
    }
    public function getShopNewsItem($id){
        return $this->M->getShopNewsItem($id);
    }
}