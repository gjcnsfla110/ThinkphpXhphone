<?php

namespace app\admin\controller;

use app\common\Base;

class CreditCard extends Base
{
    public function index(){
        $data = $this->serviceM->index($this->request->param());
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
        $status = input('status');
        $data = $this->serviceM->status($status);
        return showSuccess($data);
    }
}