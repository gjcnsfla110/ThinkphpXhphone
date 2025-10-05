<?php

namespace app\app\controller;

use app\common\Base;

class Agreement extends Base
{
     protected $noneValidateCheck = ['getAgreementList','ActiveCategoryList'];
     public function getAgreementList(){
          $data = $this->serviceM->getAgreementList();
          return showSuccess($data);
     }
     public function ActiveCategoryList(){
         $id = input('id');
         $data = $this->serviceM->ActiveCategoryList($id);
         return showSuccess($data);
     }

     public function detailItem(){
         $data = $this->serviceM->detailItem();
         return showSuccess($data);
     }

     public function getPlans(){
         $id = input('id');
         $data = $this->serviceM->getPlans($id);
         return showSuccess($data);
     }
}