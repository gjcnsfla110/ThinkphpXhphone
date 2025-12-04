<?php

namespace app\admin\validate;

class GoodsReview extends BaseValidate
{
    protected $rule = [
        'page' => 'require',
        'id'=>'require|isModel',
        'goods_id'=>'require',
        'type'=>'require',
        'title'=>'require',
    ];

    protected $message = [];

    protected $scene = [
        'index'=>['page'],
        'add'=>['goods_id','type','title'],
        'delete'=>['id'],
    ];
}