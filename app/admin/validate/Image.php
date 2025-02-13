<?php

namespace app\admin\validate;

class Image extends BaseValidate
{
    protected $rule = [
        'id'=> 'require|integer|>:0|isModel',
        'ids'=> 'require|array',
        'image_class_id'=> 'require|integer|>:0|isModel:false,ImageClass',
        'name'=>'require',
        'url'=>'require'
    ];

    protected $scene=[
        'save'=>['image_class_id','name','url'],
        'delete'=>['ids'],
        'update'=>['id','name']
    ];
}