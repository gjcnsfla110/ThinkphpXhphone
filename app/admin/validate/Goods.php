<?php

namespace app\admin\validate;

class Goods extends BaseValidate
{
    protected $rule = [
        'page'=>'require',
        'id'=>'require|isModel',
        'ids'=>'require',
        'category_id'=>'require',
        'model'=>'require',
        'label'=>'require',
        'type'=>'require',
        'title'=>'require',
        'status'=>'require',
        'price3'=>'require'
    ];

    protected $scene = [
        'index'=>['page'],
        'add'=>['category_id','model','label','type','title'],
        'update'=>['id','category_id','model','label','type','title'],
        'updateStatus'=>['id','status'],
        'updateStatusAll'=>['ids','status'],
        'delete'=>['id'],
        'deleteAll'=>['ids'],
    ];
}