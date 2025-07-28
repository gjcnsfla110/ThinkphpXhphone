<?php

namespace app\admin\service;

class GoodsSubmenu extends BaseService
{
    public function index($param){
        $page = $param['page'] ? $param['page'] : 1;
        $limit = $param['limit'] ? $param['limit'] : 10;
        $where = [];
        if(array_key_exists('category_id', $param)){
            $where[] = ['category_id',"=",$param['category_id']];
        }
        return $this->M->getList($page,$limit,$where);
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