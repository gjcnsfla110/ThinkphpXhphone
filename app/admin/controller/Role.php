<?php

namespace app\admin\controller;
use app\common\Base;

class Role extends Base
{
    public function index(){
        $page = input('page');
        $limit = input('limit');
        $data = $this->serviceM->roleList($page, $limit);
        return showSuccess($data);
    }

    public function addRole(){
        $param = $this->request->param();
        $data = $this->serviceM->addRole($param);
        return showSuccess($data);
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