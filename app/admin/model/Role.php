<?php

namespace app\admin\model;

class Role extends BaseM
{
    public function rule(){
        return $this->belongsToMany('Role','role_rule');
    }
    public function managers(){
        return  $this->hasMany('Manager');
    }
}