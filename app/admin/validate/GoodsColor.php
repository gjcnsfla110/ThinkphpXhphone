<?php

namespace app\admin\validate;

class GoodsColor extends BaseValidate
{
     protected $rule = [
         'page'=>'require',
         'id'=>'require|isModel',
         'color'=>'require',
         'english'=>'require',
         'code'=>'require'
     ];

     protected $message = [
         'page'=>'填写Page页面 code_001',
         'id'=>'填写id code_002',
         'color'=>'填写颜色名称 code_003',
         'english'=>'填写颜色英文名称 code_004',
         'code'=>'填写颜色Code code_005'
     ];

     protected $scene = [
         'index'=>['page'],
         'add'=>['color','english','code'],
         'update'=>['id','color','english','code'],
         'delete'=>['id'],
     ];
}