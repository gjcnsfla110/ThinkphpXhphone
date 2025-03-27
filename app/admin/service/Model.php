<?php

namespace app\admin\service;

class Model extends BaseService
{
    public function index($page,$limit){
        return $this->M->getAll($page,$limit);
    }

    public function add($data){
        if($data['pid'] !=0){
            $type = $this->M->where('id',$data['pid'])->value('model_type');
            if($type === null){
                ApiException("选择的父级菜单不存在！");
            }
            if($type == 0){
                ApiException("想添加的必须菜单才可以，模型下添加不了");
            }
        }
        if($data['pid'] ==0 && $data['model_type'] == 0){
            ApiException("模型必须在菜单下面添加才可以！");
        }
        return $this->M->MPsave($data);
    }

    public function update($data){
        return request()->Model->save($data);
    }

    public function updateStatus($status){
        return request()->Model->save(['status'=>$status]);
    }

    public function delete(){
        return $this->M->MPdelete();
    }
}