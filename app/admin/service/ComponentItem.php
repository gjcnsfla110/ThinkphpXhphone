<?php

namespace app\admin\service;

class ComponentItem extends BaseService
{
    public function index($id){
        return $this->M->getList($id);
    }

    public function create($data){
        return $this->M->MPsave($data);
    }

    public function delete(){
        return $this->M->MPdelete();
    }
    public function getGoodsList($param){
        $page = $param['page'] ? $param['page'] : 1;
        $limit = $param['limit'] ? $param['limit'] : 10;
        $isCheck = $param['isCheck'];
        $where = [];
        if(array_key_exists('category_id', $param)){
            $where[] = ['sideCategory_id',"=",$param['category_id']];
        }
        return $this->M->getGoodsList($page,$isCheck,$limit,$where);
    }
}