<?php

namespace app\admin\validate;

class GoodsSpec extends BaseValidate
{
    protected $rule = [
        'page'=>'require',
        'id'=>'require|integer|isModel',
        'spec_id'=>'require|isModel:false',
        'spec_type'=>'require',
        'name'=>'require',
        'model'=>'require',
        'cpu'=>'require',
        'ram'=>'require',
        'storage'=>'require',
        'color'=>'require',
        'display'=>'require',
        'battery'=>'require',
        'water'=>'require',
        'type'=>'require',
        'weight'=>'require',
        'launchDate'=>'require',
        'status'=>'require'

    ];
    protected $message = [

    ];
    protected $scene = [
        'index'=>['page'],
        'add'=>['spec_id','spec_type','name','model','cpu','ram','storage','color','display','battery','water','type','weight','launchDate','status'],
        'update'=>['id','spec_id','spec_type','name','model','cpu','ram','storage','color','display','battery','water','type','weight','launchDate','status'],
        'updateStatus'=>['id','status'],
        'delete'=>['id']
    ];
}