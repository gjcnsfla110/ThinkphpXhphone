<?php

namespace app\admin\service;

class Agreement extends BaseService
{
    public function index($param){
        $page = $param['page'] ? $param['page'] : 1;
        $limit = $param['limit'] ? $param['limit'] : 10;
        $where = [];
        if(array_key_exists('category_id', $param)){
            $where[] = ['category_id',"=",$param['category_id']];
        }
        if(array_key_exists('title', $param)){
            $where[] = ['title','like',"%".$param['title']."%"];
        }
        if(array_key_exists('mobile', $param)){
            $where[] = ['mobile','like',"%".$param['mobile']."%"];
            $where[] = ['hot',"=",1];
        }
        return $this->M->getList($page,$limit,$where);
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

    public function itemDetail($id){
        return $this->M->detail($id);
    }

    public function updateBanner($banner){
        return request()->Model->save(['banner'=>$banner]);
    }

    public function checkItemsList($param){
        $page = $param['page'] ? $param['page'] : 1;
        $limit = $param['limit'] ? $param['limit'] : 10;
        $where = [];
        if(array_key_exists('sideCategory_id', $param)){
            $where[] = ['category_id',"=",$param['sideCategory_id']];
        }
        return $this->M->checkItemsList($page,$limit,$where);
    }
}