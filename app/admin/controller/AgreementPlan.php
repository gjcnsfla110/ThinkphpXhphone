<?php

namespace app\admin\controller;

use app\common\Base;

class AgreementPlan extends Base
{
     public function index(){
         $id =input('categoryId');
         $isCheck = input('isCheck');
         $agreement_id = input('agreement_id');
         $data = $this->serviceM->index($id,$isCheck,$agreement_id);
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