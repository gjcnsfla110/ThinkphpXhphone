<?php

namespace app\admin\model;

class Role extends BaseM
{
    public function Rule(){
        return $this->belongsToMany('Role','role_rule');
    }

    public function managers(){
        return  $this->hasMany('Manager');
    }

    public function list($page,$limit=10){
        $total = $this->count();
        $list = $this->page($page,$limit)->order('id','desc')->select();
        return ["total"=>$total,"list"=>$list];
    }

}