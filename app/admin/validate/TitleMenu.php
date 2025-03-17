<?php

namespace app\admin\validate;

class TitleMenu extends BaseValidate
{
    protected $rule = [
        'id'=>'require|isModel',
        'name'=>'require',
        'child'=>'require',
        'status'=>'require|integer',
        'priority'=>'require|integer',
        'page'=>'require|integer',
    ];

    protected $message = [
        'id'=>"菜单错误",
        'name'=>"菜单名称错误",
        'child'=>"子菜单错误",
        'status'=>"状态错误",
        'priority'=>"优先级错误",
        'page'=>"查找页面错误"
    ];
    protected $scene = [
        'index'=>['page'],
        'save'=>['name','status','priority'],
        'update'=>['id'],
        'updateStatus'=>['id','status'],
        'delete'=>['id']
    ];
}