<?php

namespace app\admin\validate;

class AccessoriesSubCategory extends BaseValidate
{
    protected $rule = [
        'id' => 'require|isModel',
        'page'=> "require",
        'name' => 'require',
        'img' => 'require',
        'ranking' => 'require',
        'status' => 'require',
    ];

    protected $message = [

    ];

    protected $scene = [
        "index" => ["page"],
        'create' => ['name', 'img', 'ranking', 'status'],
        'update' => ['id', 'name', 'img', 'ranking', 'status'],
        'delete' => ['id'],
        'updateStatus' => ['id', 'status'],
    ];
}