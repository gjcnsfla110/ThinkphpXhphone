<?php

namespace app\admin\validate;

class Model extends BaseValidate
{
    protected $rule = [
        'page'=> 'require',
        'id' => 'require|isModel',
        'pid' => 'require|isModel:false',
        'model_type' => 'require',
        'name' => 'require',
        'menu' => 'require',
        'status' => 'require'
    ];

    protected $message = [
        'id' => '',
        'pid' => '',
        'model_type' => '',
        'name' => '',
        'menu' => '',
        'status' => ''
    ];

    protected $scene = [
        'index' => ['page'],
        'add' => ['pid','model_type','status'],
        'update' => ['id','pid','model_type','status'],
        'updateStatus' => ['id','status'],
        'delete' => ['id']
    ];
}