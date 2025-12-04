<?php

namespace app\admin\controller;
use app\common\Base;

class goodsCategory extends Base
{
     public function list(){
         $page = input('page');
         $limit = input('limit');
         $data = $this->serviceM->list($page,$limit);
         return showSuccess($data);
     }

     public function add(){
         $data = $this->request->param();
         $result = $this->serviceM->add($data);
         return showSuccess($result);
     }

     public function update(){
         $pram = $this->request->param();
         $data = $this->serviceM->update($pram);
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
}