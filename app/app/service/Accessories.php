<?php

namespace app\app\service;
class Accessories extends BaseService
{
    public function getSubCategoryList($id,$page,$limit){
        return $this->M->getSubCategoryList($id,$page,$limit);
    }

    public function getItem(){
        return request()->Model;
    }
}