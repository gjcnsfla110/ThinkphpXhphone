<?php

namespace app\admin\validate;

class DeliveryCompany extends BaseValidate
{
    protected $rule = [
        'page'=>'require',
        'id'=>'require|isModel',
        'name'=> 'require',
        'link'=>'require',
    ];

    protected $message = [
        'page'=>'添加page页面 code_001',
        'id'=>'添加ID code_002',
        'name'=> '添写公司名称 code_003',
        'link'=>'添写公司网址 code_004',
    ];

    protected $scene = [
        'index'=>['page'],
        'add'=>['name','link'],
        'update'=>['id','name','link'],
        'delete'=>['id']
    ];
}