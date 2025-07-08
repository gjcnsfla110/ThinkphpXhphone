<?php

namespace app\admin\validate;

class CreditCard extends BaseValidate
{
    protected $rule = [
        'page'=>'require',
        'id'=>'require|isModel',
        'card_company'=>'require',
        'sale'=>'require',
        'status'=>'require'
    ];

    protected $message = [

    ];

    protected $scene = [
        'index'=>''
    ];
}