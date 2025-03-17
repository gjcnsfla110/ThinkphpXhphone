<?php

namespace app\admin\controller;
use app\common\Base;
class TitleMenu extends Base
{

    public function index(){
        $page = input("page");
        $limit = input("limit");
        $data = $this->serviceM->getAll($page, $limit);
        return showSuccess($data);
    }

    public function save(){
         $param = $this->request->param();
         $param['child']= json_encode($param['child']);
         $data = $this->serviceM->save($param);
         return showSuccess($data);
    }

    public function update(){
        $param = $this->request->param();
        $param['child']= json_encode($param['child']);
        $data = $this->serviceM->update($param);
        return showSuccess($data);
    }

    public function updateStatus(){
        $status = input("status");
        $data = $this->serviceM->updateStatus($status);
        return showSuccess($data);
    }

    public function delete(){
        $data = $this->serviceM->delete();
        return showSuccess($data);
    }

}