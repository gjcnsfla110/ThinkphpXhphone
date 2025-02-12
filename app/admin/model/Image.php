<?php

namespace app\admin\model;

class Image extends BaseM
{
    public function imageClass(){
        return $this->belongsTo('ImageClass');
    }

    public function Mcreate($data){
       return $this->save($data);
    }
}