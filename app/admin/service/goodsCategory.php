<?php

namespace app\admin\service;

class goodsCategory extends BaseService
{
    public function list($page,$limit){
        return $this->M->getAll($page,$limit);
    }
    public function add($data){
        if($data['category_id'] != 0){
            $menu = $this->M->where('id',$data['category_id'])->value('menu');
            if($menu=== null){
                ApiException("选择的父级菜单不存在！");
            }
            if($menu == 0){
                ApiException("想添加的必须菜单才可以，内菜单下添加不了");
            }
        }
        if($data['category_id'] == 0 && $data['menu'] == 0){
            ApiException("内菜单必须在菜单下面添加才可以！");
        }
        return $this->M->MPsave($data);
    }

    public function update($data){
        return request()->Model->save($data);
    }

    public function updateStatus($status){
        return $this->M->MPupdateStatus(['status'=>$status]);
    }

    public function delete(){
        return $this->M->MPdelete();
    }
}