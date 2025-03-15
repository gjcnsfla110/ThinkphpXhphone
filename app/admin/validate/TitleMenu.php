<?php

namespace app\admin\validate;

class TitleMenu extends BaseValidate
{
    protected $rule = [
        'id'=>'require|isModel',
        'name'=>'require',
        'child'=>'require',
        'priority'=>'require|integer'
    ];

    protected $message = [

    ];
    protected $scene = [

    ];
}