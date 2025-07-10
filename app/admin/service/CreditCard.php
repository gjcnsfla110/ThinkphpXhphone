<?php

namespace app\admin\service;

class CreditCard extends BaseService
{
    public function index($param){
        $page = $param['page'] ? $param['page'] : 1;
        $limit = $param['limit'] ? $param['limit'] : 10;
        $where = [];
        if(array_key_exists('mobile', $param)){
            $where[] = ['mobile',"=",$param['mobile']];
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
        return request()->Model->delete();
    }

    public function status($status){
        return request()->Model->save(['status'=>$status]);
    }
}