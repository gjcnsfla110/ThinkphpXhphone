<?php

namespace app\admin\validate;

class UsimCategory extends BaseValidate
{
     protected $rule = [
         "page"=>"require",
         'id' => 'require|isModel',
         'name'=>'require',
         'status'=>'require',
         'hot'=>'require',
         'ranking'=>'require'
     ];

     protected $message = [];

     protected $scene = [
          'index'=>['page'],
          'add'=>['name','status','hot','ranking'],
          'update'=>['id','name','status','hot','ranking'],
          'delete'=>['id'],
          'updateStatus'=>['id','status'],
          'updateHot'=>['id','hot']
     ];
}