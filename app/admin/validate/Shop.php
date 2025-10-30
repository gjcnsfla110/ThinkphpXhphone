<?php

namespace app\admin\validate;

class Shop extends BaseValidate
{
    protected $rule = [
        'id'=>"require|isModel",
        'page'=>'require',
        'category_id'=>'require',
        'name'=>'require',
        'phone'=>'require',
        'wechat'=>'require',
        'wechatImg'=>'require',
        'mainImg'=>'require',
        'shopImg'=>'require',
        'directionsImg'=>'require',
        'shop_introduction'=>'require',
        'hours'=>'require',
        'address'=>'require',
        'status'=>'require'
    ];
    protected $message = [];
    protected $scene = [
        'index'=>['page'],
        'add'=>['category_id','name','phone','wechat','wechatImg','mainImg','shopImg','directionsImg','shop_introduction','hours','address','status'],
        'update'=>['id','category_id','name','phone','wechat','wechatImg','mainImg','shopImg','directionsImg','shop_introduction','hours','address','status'],
        'updateStatus'=>['id','status'],
        'updateBanner'=>['id','shopImg'],
        'delete'=>['id'],
    ];
}