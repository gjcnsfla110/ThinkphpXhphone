<?php

namespace app\admin\validate;

class ComponentName extends BaseValidate
{
    protected $rule = [
        'id'=>'require|isModel',
        'page'=>'require',
        'name'=>'require'
    ];

    protected $message = [

    ];

    protected $scene = [
        'index'=>['page'],
        'create'=>['name'],
        'update'=>['id','name'],
        'delete'=>['id']
    ];
}