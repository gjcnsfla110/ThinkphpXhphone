<?php

namespace app\admin\service;

class Rule extends BaseService
{
    public function list($page,$limit){
        return $this->M->Mlist($page,$limit);
    }

    public function addRule($data){
        if($data['rule_id'] != 0){
            $menu = $this->M->where('id',$data['rule_id'])->value('menu');
            if($menu == null){
                ApiException("选择的父级菜单不存在！");
            }
            if($menu != 1){
                ApiException("想添加的必须菜单才可以，权限下添加不了");
            }
        }
        return $this->M->MPsave($data);
    }

    public function updateRule($data){
        return request()->Model->save($data);
    }

    public function updateStatus($id,$status){
        return $this->M->MupdateStatus($id,$status);
    }

    public function deleteRule(){
        return request()->Model->delete();
        //return $this->M->MPdelereOne(['id'=>$id]);
    }
}