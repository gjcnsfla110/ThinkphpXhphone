<?php

namespace app\app\validate;

class SubMenu extends BaseValidate
{
    protected $rule = [
        'categoryId'=>'require',
    ];

    protected $message = [];

    protected $scene = [
        'getSubMenuCategory'=>['categoryId']
    ];
}