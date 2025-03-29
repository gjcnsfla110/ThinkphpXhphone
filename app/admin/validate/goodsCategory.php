<?php

namespace app\admin\validate;

class goodsCategory extends BaseValidate
{
     protected $rule = [
         'id' => 'require|isModel',
         'page'=>"require",
         'category_id' => 'require|isModel:false',
         'name' => 'require',
         'status'=>'require'
     ];
     protected $message = [
         'id'=>"没有此信息 code_001",
         'category_id'=>"没有此信息 code_002",
         'name'=>"请填写菜单名字 code_003",
         'status'=>"选择状态 code_004"
     ];
     protected $scene = [
         'list'=>['page'],
         'add'=>['category_id','name','status'],
         'update'=>['id','category_id','name','status'],
         'updateStatus'=>['id','status'],
         'delete'=>['id']
     ];
}