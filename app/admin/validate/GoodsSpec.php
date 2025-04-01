<?php

namespace app\admin\validate;

class GoodsSpec extends BaseValidate
{
    protected $rule = [
        'page'=>'require',
        'id'=>'require|integer|isModel',
        'spec_id'=>'require|isModel:false',
        'spec_menu'=>'require',
        'status'=>'require'

    ];
    protected $message = [

    ];
    protected $scene = [
        'index'=>['page'],
        'add'=>['spec_id','spec_menu'],
        'update'=>['id','spec_id','spec_menu'],
        'updateStatus'=>['id','status'],
        'delete'=>['id']
    ];
}