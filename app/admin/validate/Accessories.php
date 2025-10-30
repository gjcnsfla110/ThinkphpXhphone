<?php

namespace app\admin\validate;

class Accessories extends BaseValidate
{
    protected $rule = [
        'page'=>'require',
        'id'=>'require|isModel',
        'ids'=>'require',
        'category_id'=>'require',
        'label'=>'require',
        'label_color'=>'require',
        'title'=>'require',
        'status'=>'require',
        'banner'=>'require',
    ];

    protected $scene = [
        'index'=>['page'],
        'add'=>['category_id','label','label_color','title'],
        'update'=>['id','category_id','label','label_color','title'],
        'updateStatus'=>['id','status'],
        'checkUpdateStatus'=>['ids','status'],
        'updateShopImg'=>['id'],
        'delete'=>['id'],
        'deleteAll'=>['ids'],
    ];
}