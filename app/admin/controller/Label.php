<?php

namespace app\admin\controller;

use app\common\Base;

class Label extends Base
{

    public function index(){
        $page=input('page');
        $limit=input('limit');
        $data = $this->serviceM->index($page,$limit);
        return showSuccess($data);
    }

    public function add(){
        $data = $this->serviceM->add($this->request->param());
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

}