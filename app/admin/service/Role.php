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

    public function updateRole(){

    }

    public function deleteRole(){

    }

    public function updateStatus(){

    }

    public function addRules(){

    }
}