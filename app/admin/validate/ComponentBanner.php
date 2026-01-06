<?php

namespace app\admin\validate;

class ComponentBanner extends BaseValidate
{
     protected $rule = [
         'id'=>'require|isModel',
         'component_id'=>'require',
         'image'=>'require',
         'banner_type'=>'require',
         'banner_item_id'=>'require',
         'status'=>'require',
         'ranking'=>'require',
         'itemId'=> 'require'
     ];

     protected $message = [];

     protected $scene = [
         'index'=>['component_id'],
         'create'=>['component_id','image','banner_type','banner_item_id','status','ranking'],
         'update'=>['id','image','banner_type','banner_item_id','status','ranking'],
         'delete'=>['id'],
         'updateStatus'=>['id','status'],
         'getGoodsItem'=>['itemId'],
         'getAgreementItem'=>['itemId'],
         'getUsimItem'=>['itemId'],
         'getAccessoriesItem'=>['itemId'],
         'getCategoryItem'=>['itemId'],
         'getShopNewsItem'=>['itemId'],
     ];
}