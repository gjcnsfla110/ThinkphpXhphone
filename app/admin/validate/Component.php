<?php

namespace app\admin\validate;

class Component extends BaseValidate
{
    protected $rule = [
         'id'=>'require|isModel',
         'page'=>'require',
         'page_id'=>'require',
         'component'=>'require',
         'title'=>'require',
         'title1'=>'require',
         'content_title'=>'require',
         'content_title1'=>'require',
         'more'=>'require',
         'more_link'=>'require',
         'img'=>'require',
         'top_img'=>'require',
         'banner'=>'require',
         'item_size'=>'require',
         'ranking'=>'require',
         'status'=>'require'
    ];

    protected $message = [];

    protected $scene = [
      'index'=>['page'],
      'create'=>['page_id','component','title'],
      'update'=>['id','page_id','component','title'],
      'delete'=>['id'],
      'updateStatus'=>['id','status']
    ];
}