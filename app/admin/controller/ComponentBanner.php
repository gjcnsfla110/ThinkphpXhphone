<?php

namespace app\admin\controller;

use app\common\Base;

class ComponentBanner extends Base
{
     public function index(){
          $component_id = input('param.component_id');
          $data = $this->serviceM->index($component_id);
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
         $data = $this->serviceM->updateStatus($status);
         return showSuccess($data);
     }

     public function getGoodsItem(){
            $id = input('itemId');
            $data = $this->serviceM->getGoodsItem($id);
            return showSuccess($data);
     }

    public function getAgreementItem(){
            $id = input('itemId');
            $data = $this->serviceM->getAgreementItem($id);
            return showSuccess($data);
    }

    public function getUsimItem(){
            $id = input('itemId');
            $data = $this->serviceM->getUsimItem($id);
            return showSuccess($data);
    }

    public function getAccessoriesItem(){
            $id = input('itemId');
            $data = $this->serviceM->getAccessoriesItem($id);
            return showSuccess($data);
    }
    public function getCategoryItem(){
            $id = input('itemId');
            $data = $this->serviceM->getCategoryItem($id);
            return showSuccess($data);
    }
    public function getShopNewsItem(){
            $id = input('itemId');
            $data = $this->serviceM->getShopNewsItem($id);
            return showSuccess($data);
    }

}