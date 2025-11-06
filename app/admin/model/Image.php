<?php

namespace app\admin\model;

class Image extends BaseM
{
    public function imageClass(){
        return $this->belongsTo('ImageClass');
    }

}