<?php

namespace app\admin\validate;

class AccessoriesReview extends BaseValidate
{
    protected $rule = [
        'page' => 'require',
        'id'=>'require|isModel',
        'accessories_id'=>'require',
        'type'=>'require',
        'title'=>'require',
    ];

    protected $message = [];

    protected $scene = [
        'index'=>['page'],
        'add'=>['accessories_id','type','title'],
        'delete'=>['id'],
    ];
}