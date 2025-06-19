<?php

namespace app\admin\controller;

use app\common\Base;

class AgreementPlan extends Base
{
     public function index(){
         $id =input('categoryId');
         $data = $this->serviceM->index($id);
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
     }
}