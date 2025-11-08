<?php

namespace app\admin\validate;

class Image extends BaseValidate
{
    protected $rule = [
        'id'=> 'require|integer|>:0|isModel',
        'image_class_id'=> 'require|integer|>:0|isModel:false,ImageClass',
        'original_name'=>'require'
    ];

    protected $scene=[
        'save'=>['image_class_id'],
        'delete'=>['id'],
        'update'=>['id','original_name']
    ];
}