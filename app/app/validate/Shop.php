<?php

namespace app\app\validate;

class Shop extends BaseValidate
{
    protected $rule = [
        'id' => 'require|isModel',
    ];
    protected $message = [];
    protected $scene = [
        'getShopDate'=>['id']
    ];
}