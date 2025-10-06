<?php

namespace app\admin\validate;

class ComponentItem extends BaseValidate
{
     protected $rule = [
         'id'=>'require|isModel',
         'component_id'=>'require',
         'category_id'=>'require',
         'goods_id'=>'require',
         'ranking'=>'require',
         'listType'=>'require'
     ];
     protected $message = [];
     protected $scene = [
         'index'=>['component_id'],
         'create'=>['component_id'],
         'delete'=>['id'],
         'getGoodsList'=>['page'],
         'getGoods'=>['goods_id'],
         'updateChangeListType'=>['id','listType']
     ];
}