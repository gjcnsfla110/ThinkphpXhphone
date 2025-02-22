<?php

namespace app\admin\service;

class Role extends BaseService
{
    public function roleList($page,$limit){
        return $this->M->list($page,$limit);
    }

    public function addRole($param){
        return $this->M->MPsave($param);
    }

    public function updateRole($data){
        return $this->M->MPupdate($data);
    }

    public function deleteRole($id){
        return request()->Model->delete();
    }

    public function updateStatus($data){
        return $this->M->MPupdate($data);
    }

    public function addRules(){

    }
}