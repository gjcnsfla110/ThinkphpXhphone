<?php

namespace app\admin\model;

class Role extends BaseM
{
    public function Rule(){
        return $this->belongsToMany('Role','role_rule');
    }

    public function list($page,$limit){
        $total = $this->count();
        $list = $this->limit($page,$limit)->order('id','desc')->select();
        return ["total"=>$total,"list"=>$list];
    }

}