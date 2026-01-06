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
        $items = input('items');
        $data = $this->serviceM->create($items);
        return showSuccess($data);
    }

    public function delete(){
        $data = $this->serviceM->delete();
        return showSuccess($data);
    }

    public function updateRanking(){
        $data = $this->serviceM->updateRanking(input('ranking'));
        return showSuccess($data);
    }

    public function getGoodsList(){
        $data = $this->serviceM->getGoodsList($this->request->param());
        return showSuccess($data);
    }

    public function updateChangeListType(){
          $listType = input('listType');
          $data = $this->serviceM->updateChangeListType($listType);
          return showSuccess($data);
    }

    public function getGoods(){
        $itemId = input('item_id');
        $data = $this->serviceM->getGoods($itemId);
        return showSuccess($data);
    }

    public function getAccessories(){
        $itemId = input('item_id');
        $data = $this->serviceM->getAccessories($itemId);
        return showSuccess($data);
    }

    public function getAgreement(){
        $itemId = input('item_id');
        $data = $this->serviceM->getAgreement($itemId);
        return showSuccess($data);
    }

    public function getUsim(){
        $itemId = input('item_id');
        $data = $this->serviceM->getUsim($itemId);
        return showSuccess($data);
    }
}