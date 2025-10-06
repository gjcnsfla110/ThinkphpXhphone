<?php

namespace app\admin\validate;

class Component extends BaseValidate
{
    protected $rule = [
         'id'=>'require|isModel',
         'page'=>'require',
         'page_key'=>'require',
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
      'create'=>['page_key','component','item_size'],
      'update'=>['id','page_key','component','item_size'],
      'delete'=>['id'],
      'updateStatus'=>['id','status']
    ];
}