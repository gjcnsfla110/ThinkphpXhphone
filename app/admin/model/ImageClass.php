<?php

namespace app\admin\model;

class ImageClass extends BaseM
{
    public function images(){
         return $this->hasOne('Image');
    }

    public function Mcreate($data){
        $this->create($data);
    }
}