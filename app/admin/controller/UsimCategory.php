<?php

namespace app\admin\controller;
use app\common\Base;

class UsimCategory extends Base
{
     public function index(){
          $page = input("page");
          $limit = input("limit");
          $data = $this->serviceM->index($page,$limit);
          return showSuccess($data);
     }

     public function add(){
         $data = $this->serviceM->add(request()->param());
         return showSuccess($data);
     }

     public function update(){
        $data = $this->serviceM->update(request()->param());
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

     public function updateHot(){
         $hot = input('hot');
         $data = $this->serviceM->updateHot($hot);
         return showSuccess($data);
     }
}