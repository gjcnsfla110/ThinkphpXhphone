<?php

namespace app\admin\validate;

class ComponentItem extends BaseValidate
{
     protected $rule = [
         'id'=>'require|isModel',
         'component_id'=>'require',
         'category_id'=>'require',
         'item_id'=>'require',
         'ranking'=>'require',
         'listType'=>'require'
     ];
     protected $message = [];
     protected $scene = [
         'index'=>['component_id'],
         'create'=>['component_id'],
         'delete'=>['id'],
         'getGoodsList'=>['page'],
         'updateChangeListType'=>['id','listType'],
         'updateRanking'=>['id','ranking'],
         'getGoods'=>['item_id'],
         'getAccessories'=>['item_id'],
         'getAgreement'=>['item_id'],
         'getUsim'=>['item_id'],
     ];
}