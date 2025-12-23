<?php

namespace app\admin\validate;

class SubMenu extends BaseValidate
{
    protected $rule = [
        'page'=>'require',
        'id'=>'require|isModel',
        'name'=>'require',
        'img'=>'require',
        'status'=>'require',
        'ranking'=>'require'
    ];

    protected $message = [];

    protected $scene = [
        'index'=>['page'],
        'create'=>['name','img','status'],
        'update'=>['id','name','img','status'],
        'delete'=>['id'],
        'updateStatus'=>['id','status']
    ];
}