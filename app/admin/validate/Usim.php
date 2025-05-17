<?php

namespace app\admin\validate;

class Usim extends BaseValidate
{
    protected $rule = [
        'page'=>'require',
        'id'=>'require|isModel',
        'category_id'=>'require',
        'detail'=>'require',
        'mobile'=>'require',
        'price'=>'require',
        'data'=>'require',
        'talk_time'=>'require',
        'mns'=>'require',
        'other'=>'require',
        'agreement'=>'require',
        'ranking'=>'require',
        'status'=>'require',
        'hot'=>'require'
    ];

    protected $message = [

    ];

    protected $scene = [
        'index'=>['page'],
        'create'=>['category_id','detail','mobile','price','data','talk_time','mns','other','agreement','ranking','status'],
        'update'=>['id','category_id','detail','mobile','price','data','talk_time','mns','other','agreement','ranking','status'],
        'delete'=>['id'],
        'updateStatus'=>['id','status'],
        'updateHot'=>['id','hot']
    ];
}