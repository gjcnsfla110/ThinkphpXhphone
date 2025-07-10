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
        'index'=>['page'],
         'create'=>['card_company','sale','status'],
        'update'=>['id','card_company','sale','status'],
        'delete'=>['id'],
        'updateStatus'=>['id']
    ];
}