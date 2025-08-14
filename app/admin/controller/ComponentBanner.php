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
         $component_id = input('param.component_id');
         $addData = $this->request->param();
         $data = $this->serviceM->create($component_id,$addData);
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
}