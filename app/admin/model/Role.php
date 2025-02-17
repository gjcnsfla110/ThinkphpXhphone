<?php

namespace app\admin\model;

class Role extends BaseM
{
    public function Rule(){
        return $this->belongsToMany('Role','role_rule');
    }
}