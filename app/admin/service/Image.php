<?php

namespace app\admin\service;

class Image extends BaseService
{
    public function saveImg($data){
        return $this->M->Mcreate($data);
    }

    public function deleteImg($ids){
        return $this->M->Mdelete($ids);
    }

    public function updateImg($data){
        return $this->M->Mupdate($data);
    }
}