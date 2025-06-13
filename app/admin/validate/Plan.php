<?php

namespace app\admin\validate;

class Plan extends BaseValidate
{
    protected $rule = [
        'page'=>'require',
        'id'=>"require|isModel",
        'category_id'=> 'require',
        'price'=>'require',
        'title'=>'require',
        'detail'=>'require',
        'ranking'=>'require',
        'status'=>'require'
    ];

    protected $message = [

    ];

    protected $scene = [
        'index'=>['page'],
        'create'=>['category_id','price','title','detail','ranking','status'],
        'update'=>['id','category_id','price','title','detail','ranking','status'],
        'delete'=>['id'],
        'updateStatus'=>['id','updateStatus']
    ];
}