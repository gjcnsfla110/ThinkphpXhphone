<?php

namespace app\admin\validate;

class ComponentBanner extends BaseValidate
{
     protected $rule = [
         'id'=>'require|isModel',
         'component_id'=>'require',
         'img'=>'require',
         'link'=>'require',
         'status'=>'require',
         'ranking'=>'require'
     ];

     protected $message = [];

     protected $scene = [
         'index'=>['component_id'],
         'create'=>['component_id','img','link','status','ranking'],
         'update'=>['id','img','link','status','ranking'],
         'delete'=>['id'],
         'updateStatus'=>['id','status']
     ];
}