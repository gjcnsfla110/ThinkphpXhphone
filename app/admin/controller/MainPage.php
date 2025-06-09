<?php

namespace app\admin\controller;
use app\common\Base;

class MainPage extends Base
{
    public function index(){
        $page = input("page");
        $limit = input("limit");
        $data = $this->serviceM->index($page, $limit);
        return showSuccess($data);
    }

    public function create(){
        $data = $this->serviceM->create($this->request->param());
        return showSuccess($data);
    }

    public function update(){
        $data = $this->serviceM->update($this->request->param());
        return showSuccess($data);
    }

    public function delete(){
        $data = $this->serviceM->delete();
        return showSuccess($data);
    }

    public function updateStatus(){
        $status = input("status");
        $data = $this->serviceM->updateStatus($status);
        return showSuccess($data);
    }
}