<?php

namespace app\admin\service;

class Image extends BaseService
{
    public function saveImg($data){
        return $this->M->Mcreate($data);
    }

    public function deleteImg(){

    }

    public function updateImg(){

    }
}