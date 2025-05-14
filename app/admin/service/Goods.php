<?php

namespace app\admin\service;

class Goods extends BaseService
{
    public function index($param){
        $page = $param['page'] ? $param['page'] : 1;
        $limit = $param['limit'] ? $param['limit'] : 10;
        $isCheck = $param['isCheck'];
        $where = [];
        if(array_key_exists('category_id', $param)){
            $where[] = ['category_id',"=",$param['category_id']];
        }
        if(array_key_exists('model', $param)){
            $where[] = ['model','=',$param['model']];
        }
        if(array_key_exists('type', $param)){
            $where[] = ['type','=',$param['type']];
        }
        if(array_key_exists('title1', $param)){
            $where[] = ['title1','like',"%".$param['title1']."%"];
        }
        return $this->M->getList($page,$isCheck,$limit,$where);
    }
    public function add($data){
        $data['service'] = json_encode($data['service']);
        $data['banner'] = json_encode($data['banner']);
        $data['delivery'] = json_encode($data['delivery']);
        return $this->M->MPsave($data);
    }

    public function update($data){
        $data['service'] = json_encode($data['service']);
        $data['banner'] = json_encode($data['banner']);
        $data['delivery'] = json_encode($data['delivery']);
        return request()->Model->save($data);
    }
    public function updateBanner($banner){
        return request()->Model->save(['banner'=>json_encode($banner)]);
    }
    public function updateStatus(){

    }

    public function checkUpdateStatus(){

    }

    public function delete(){

    }

    public function deleteAll(){

    }
}