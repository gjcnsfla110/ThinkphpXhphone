<?php

namespace app\admin\validate;

class Model extends BaseValidate
{
    protected $rule = [
        'page'=> 'require',
        'id' => 'require|isModel',
        'pid' => 'require|isModel:false',
        'model_type' => 'require',
        'name' => 'require',
        'menu' => 'require',
        'status' => 'require',
        'ranking'=>'require'
    ];

    protected $message = [
        'id' => '请填写ID_code001',
        'pid' => '请填写父级ID_code002',
        'model_type' => '请选择菜单或模型_code003',
        'name' => '请填写模型名称_code004',
        'menu' => '请填写菜单名称_code005',
        'status' => '请选择状态_code006',
        'ranking'=>'请排优先级_code007'
    ];

    protected $scene = [
        'index' => ['page'],
        'add' => ['pid','model_type','status','ranking'],
        'update' => ['id','pid','model_type','status','ranking'],
        'updateStatus' => ['id','status'],
        'delete' => ['id']
    ];
}