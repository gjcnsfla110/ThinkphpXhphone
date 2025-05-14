<?php

namespace app\admin\service;

class UsimCategory extends BaseService
{
    public function index($page,$limit){
         return $this->M->getList($page,$limit);
    }

    public function add(){

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