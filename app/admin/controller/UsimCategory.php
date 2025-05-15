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

     }

     public function delete(){

     }

     public function updateStatus(){

     }

     public function updateHot(){

     }
}