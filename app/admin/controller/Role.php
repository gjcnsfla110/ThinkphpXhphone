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
        $param = $this->request->param();
        $data = $this->serviceM->updateRole($param);
        return showSuccess($data);
    }

    public function deleteRole(){
        $data = $this->serviceM->deleteRole();
        return showSuccess($data);
    }

    public function updateStatus(){
        $param = $this->request->param();
        $data = $this->serviceM->updateStatus($param);
        return showSuccess($data);
    }

    public function updateRules(){
        $id = input('id');
        $ruleIds = input('ruleIds');
        $data = $this->serviceM->updateRules($id,$ruleIds);
    }
}