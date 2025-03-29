<?php

namespace app\admin\validate;

class Brand extends BaseValidate
{
    protected $rule = [
        'page'=>'require',
        'id'=>'require|isModel',
        'name'=>'require',
        'introduce'=>'require',
        'nation'=>'require',
        'logo'=>'require',
    ];

    protected $message = [
        'page'=>'请添加邀请页面 code_001',
        'id'=>'填写id code_002',
        'name'=>'填写 品牌名称 code_003',
        'introduce'=>'填写 品牌介绍 code_004',
        'nation'=>'填写 生产地区 code_005',
        'logo'=>'填写 logo 图片 code_006',
    ];

    protected $scene = [
        'index'=>['page'],
        'add'=>['name','introduce','nation'],
        'update'=>['id','name','introduce','nation'],
        'delete'=>['id']
    ];
}