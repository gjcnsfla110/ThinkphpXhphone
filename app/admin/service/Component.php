<?php

namespace app\admin\service;

class Component extends BaseService
{
    public function index($param){
        $page = $param['page'] ? $param['page'] : 1;
        $limit = $param['limit'] ? $param['limit'] : 10;
        $where = [];
        if(array_key_exists('page_id', $param)){
            $where[] = ['page_id',"=",$param['page_id']];
        }
        return $this->M->getList($page,$limit,$where);
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

    public function updateStatus($status){
        return $this->Model->save(['status'=>$status]);
    }
}