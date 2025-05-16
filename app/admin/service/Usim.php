<?php

namespace app\admin\service;

class Usim extends BaseService
{
    public function index($param){
        $page = $param['page'] ? $param['page'] : 1;
        $limit = $param['limit'] ? $param['limit'] : 10;
        $isCheck = $param['isCheck'];
        $where=[];
        if(array_key_exists('category_id', $param)){
            $where[] = ['category_id',"=",$param['category_id']];
        }
        if(array_key_exists('mobile', $param)){
            $where[] = ['mobile','=',$param['mobile']];
        }
        if(array_key_exists('title', $param)){
            $where[] = ['title','like',"%".$param['title']."%"];
        }
        return $this->M->getUsimList($page,$limit,$where,$isCheck);
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

    public function updateStatus($status){
        return request()->Model->save(['status'=>$status]);
    }

    public function updateHot($hot){
        return request()->Model->save(['hot'=>$hot]);
    }
}