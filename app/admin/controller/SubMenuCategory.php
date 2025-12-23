<?php

namespace app\admin\controller;

use app\common\Base;

class SubMenuCategory extends Base
{
    public function index(){
        $param = $this->request->param();
        $data = $this->serviceM->index($param);
        return showSuccess($data);
    }

    public function create(){
        $param = $this->request->param();
        $data = $this->serviceM->create($param);
        return showSuccess($data);
    }

    public function update(){
        $param = $this->request->param();
        $data = $this->serviceM->update($param);
        return showSuccess($data);
    }

    public function delete(){
        $data = $this->serviceM->delete();
        return showSuccess($data);
    }

    public function addItems(){
        $items = input('items');
        $data = $this->serviceM->addItems($items);
        return showSuccess($data);
    }

    public function deleteItem(){
        $itemId = input('itemId');
        $itemUid = input('itemUid');
        $data = $this->serviceM->deleteItem($itemId,$itemUid);
        return showSuccess($data);
    }

    public function updateStatus(){
        $status = input('status');
        $data = $this->serviceM->updateStatus($status);
        return showSuccess($data);
    }

    public function getOneItem(){
        $data = $this->serviceM->getOneItem();
        return showSuccess($data);
    }
}