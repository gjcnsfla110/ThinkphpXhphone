<?php

namespace app\admin\service;

class Accessories extends BaseService
{
    public function index($param){
        $page = $param['page'] ? $param['page'] : 1;
        $limit = $param['limit'] ? $param['limit'] : 10;
        $isCheck = $param['isCheck'];
        $where = [];
        if(array_key_exists('sideCategory_id', $param)){
            $where[] = ['sideCategory_id',"=",$param['sideCategory_id']];
        }
        if(array_key_exists('item_number', $param)){
            $where[] = ['item_number',"=",$param['item_number']];
        }
        if(array_key_exists('title', $param)){
            $where[] = ['title','like',"%".$param['title']."%"];
        }
        return $this->M->getList($page,$isCheck,$limit,$where);
    }
    public function add($data){
        return $this->M->MPsave($data);
    }

    public function update($data){
        return request()->Model->save($data);
    }
    public function updateBanner($banner){
        return request()->Model->save(['banner'=>json_encode($banner)]);
    }

    public function checkUpdateStatus($status, $ids){
        return $this->M->checkUpdateStatus($status, $ids);
    }

    public function delete(){
        return $this->M->MPdelete();
    }

    public function deleteAll($ids){
        return $this->M->deleteAll($ids);
    }

    public function updateStatus($status){
        return request()->Model->save(['status'=>$status]);
    }
}