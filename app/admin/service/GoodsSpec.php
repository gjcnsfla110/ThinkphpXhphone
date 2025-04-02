<?php

namespace app\admin\service;

class GoodsSpec extends BaseService
{
    public function getAll($page,$limit = 10){
        return $this->M->getAll($page,$limit);
    }

    public function add($data){
        if($data['spec_id'] != 0){
            $spec_menu = $this->M->where('spec_id',$data['spec_id'])->column('spec_menu');
            if($spec_menu=== null){
                ApiException("选择的父级菜单不存在！");
            }
            if($spec_menu == 0){
                ApiException("想添加的必须菜单才可以，配置下添加不了");
            }
        }
        if($data['spec_id'] == 0 && $data['spec_menu'] == 0){
            ApiException("配置必须在菜单下面添加才可以！");
        }
        $data['ram'] = json_encode($data['ram']);
        $data['storage'] = json_encode($data['storage']);
        return $this->M->MPsave($data);
    }

    public function update($data){
        $data['ram'] = json_encode($data['ram']);
        $data['storage'] = json_encode($data['storage']);
        return request()->Model->save($data);
    }

    public function updateStatus($status){
        return $this->M->MPupdateStatus(['status'=>$status]);
    }

    public function delete(){
        return $this->M->MPdelete();
    }
}