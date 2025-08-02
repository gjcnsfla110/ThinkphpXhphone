<?php

namespace app\admin\validate;

class ComponentItem extends BaseValidate
{
     protected $rule = [
         'id'=>'require|isModel',
         'component_id'=>'require',
         'goods_id'=>'require',
         'title'=>'require',
         'img'=>'require',
         'label'=>'require',
         'label_color'=>'require',
         'storage'=>'require',
         'price'=>'require',
         'price1'=>'require',
         'price2'=>'require',
         'ranking'=>'require'
     ];
     protected $message = [];
     protected $scene = [
         'index'=>['component_id'],
         'create'=>['component_id','goods_id','title','img','label_color','storage','price','price1','price2','ranking'],
         'delete'=>['id'],
         'getGoodsList'=>['page']
     ];
}