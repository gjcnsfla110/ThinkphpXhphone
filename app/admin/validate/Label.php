<?php

namespace app\admin\validate;

class Label extends BaseValidate
{
    protected $rule = [
        'page'=>'require',
        'id'=>'require|isModel',
        'name'=>'require'
    ];

    protected $message = [
        'page'=>'填写page页面 code_001',
        'id'=>'填写ID code_002',
        'name'=>'填写标签名称 code_003'
    ];

    protected $scene = [
        'index'=>['page'],
        'add'=>['name'],
        'update'=>['id','name'],
        'delete'=>['id']
    ];
}