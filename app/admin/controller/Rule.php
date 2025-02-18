<?php

namespace app\admin\controller;

use app\common\Base;
class Rule extends Base
{
    protected $noneValidateCheck=['addRule'];
    public function index(){
        $page = input('page');
        $limit = input('limit');
        $data = $this->serviceM->list($page,$limit);
        return showSuccess($data);
    }

    public function addRule(){
        $param = $this->request->param();
        $data = $this->serviceM->addRule($param);
        return showSuccess($data);
    }

    public function updateRule(){
        $param = $this->request->param();
        $data = $this->serviceM->updateRule($param);
        return showSuccess($data);
    }

    public function updateStatus(){
        $id = input('id');
        $status = input('status');
        $data = $this->serviceM->updateStatus($id,$status);
        return showSuccess($data);
    }

    public function deleteRule(){
        $id =input('id');
        $data = $this->serviceM->deleteRule($id);
        return showSuccess($data);
    }

}