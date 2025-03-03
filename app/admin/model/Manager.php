<?php

namespace app\admin\model;
use app\admin\model\Role;
class Manager extends BaseM
{
    public function role(){
        return $this->belongsTo('Role');
    }

    public function getManagers($page, $limit, $username){
        $managers = $this->where('username', 'like', "%$username%")->page($page, $limit)->with(
            ['role' => function($query){
                $query->field(['id', 'name']);
            }]
        )->order('id','desc')->select();
        $total = $this->where('username', 'like', "%$username%")->count();
        $roles = Role::field(['id', 'name'])->select();
        return ['list' => $managers, 'total' => $total, 'roles'=> $roles];
    }

}