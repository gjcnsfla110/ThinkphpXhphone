<?php

namespace app\admin\validate;

class PlanCategory extends BaseValidate
{
    protected $rule = [
        'page'=>'require',
        'id'=> 'require|isModel',
        'name'=> 'require',
        'status'=>'require',
        'ranking'=>'require'
    ];

    protected $message = [

    ];

    protected $scene = [
        'index'=>['page'],
        'create'=>['name','status','ranking'],
        'update'=>['id','name','status','ranking'],
        'delete'=>['id'],
        'updateStatus'=>['id','status']
    ];
}