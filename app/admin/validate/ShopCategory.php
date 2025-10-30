<?php

namespace app\admin\validate;

class ShopCategory extends BaseValidate
{
    protected $rule = [
        'id' => 'require|isModel',
        'name' => 'require',
        'pid' => 'require|isModel:false',
        'status' => 'require',
        'ranking'=>'require'
    ];
    protected $message = [];
    protected $scene = [
        'list'=>[],
        'add' => ['name', 'status','ranking','pid'],
        'update'=>['id','name','status','ranking','pid'],
        'delete'=>['id'],
        'updateStatus'=>['id','status']
    ];
}