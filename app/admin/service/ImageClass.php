<?php

namespace app\admin\service;

class ImageClass
{
    public function addImgClass($data){
        $this->M->Mcreate($data);
    }
}