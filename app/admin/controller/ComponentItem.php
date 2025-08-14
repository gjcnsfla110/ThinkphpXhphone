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
        $component_id = input('component_id');
        $items = input('items');
        $data = $this->serviceM->create($component_id,$items);
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

    public function getGoods(){
          $goods_id = input('goods_id');
          $data = $this->serviceM->getGoods($goods_id);
          return showSuccess($data);
    }
}