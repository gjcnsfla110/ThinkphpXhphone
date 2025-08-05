<?php

namespace app\admin\controller;

use app\common\Base;

class ComponentItem extends Base
{
    public function index(){
        $id = input('component_id');
        $data = $this->serviceM->index($id);
        return showSuccess($data);
    }

    public function create(){
        $data = $this->serviceM->create($this->request->param());
        return showSuccess($data);
    }

    public function delete(){
        $data = $this->serviceM->delete();
        return showSuccess($data);
    }

    public function getGoodsList(){
        $data = $this->serviceM->getGoodsList($this->request->param());
        return showSuccess($data);
    }
}