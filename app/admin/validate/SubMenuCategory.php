<?php

namespace app\admin\validate;

class SubMenuCategory extends BaseValidate
{
    protected $rule = [
        'id'=>'require|isModel',
        'page'=>'require',
        'name'=>'require',
        'type'=>'require',
        'status'=>'require',
        'itemId'=>'require',
        'itemUid'=>'require'
    ];

    protected $message = [];

    protected $scene = [
        'index'=>['page'],
        'create'=>['name','type'],
        'update'=>['id','name','type'],
        'delete'=>['id'],
        'updateStatus'=>['id','status'],
        'addItems'=>['id'],
        'getOneItem'=>['id'],
        'deleteItem'=>['id','itemId','itemUid']
    ];
}