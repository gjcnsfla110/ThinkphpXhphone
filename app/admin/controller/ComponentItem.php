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
        $page = input('page');
        $limit = input('limit');
        $data = $this->serviceM->getGoodsList($page, $limit);
        return showSuccess($data);
    }
}