<?php

namespace app\admin\validate;

class Service extends BaseValidate
{
     protected $rule = [
         'page'=>'require',
         'id'=>'require|isModel',
         'title'=>'require',
         'description'=>'require'
     ];

     protected $message = [
         'page'=>'填写page页面 code_001',
         'id'=>'填写ID code_002',
         'title'=>'填写服务名称 code_003',
         'description'=>'填写服务详细 code_004'
     ];

     protected $scene = [
         'index'=>['page'],
         'add'=>['title','description'],
         'update'=>['id','title','description'],
         'delete'=>['id']
     ];
}