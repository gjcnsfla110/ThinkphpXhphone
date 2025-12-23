<?php

namespace app\admin\controller;

use app\common\Base;

class Agreement extends Base
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

     public function updateStatus(){
        $status = input('status');
        $data = $this->serviceM->updateStatus($status);
        return showSuccess($data);
     }

     public function delete(){
        $data = $this->serviceM->delete();
        return showSuccess($data);
     }

     public function itemDetail(){
         $id = input('id');
        $data = $this->serviceM->itemDetail($id);
        return showSuccess($data);
     }

     public function updateBanner(){
          $banner = input('banner');
          $data = $this->serviceM->updateBanner($banner);
          return showSuccess($data);
     }

     public function updateHot(){
         $hot = input('hot');
         $data = $this->serviceM->updateHot($hot);
         return showSuccess($data);
     }

    public function checkItemsList(){
        $param = request()->param();
        $data = $this->serviceM->checkItemsList($param);
        return showSuccess($data);
    }
}