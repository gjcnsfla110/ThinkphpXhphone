<?php

namespace app\admin\model;
class Manager extends BaseM
{
    public function Role(){
        return $this->belongsTo('Role');
    }
}