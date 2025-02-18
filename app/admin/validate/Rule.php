<?php

namespace app\admin\validate;

class Rule extends BaseValidate
{
        protected $rule = [
            'id'=> 'require|integer|>:0|isModel',
            'page'=> 'require|integer|>:0',
            'rule_id'=>'require|integer',
            'name'=>'require',
            'status'=>'require|number',
            'order'=>'require|number',
            'method'=>'require',
            'condition'=>'require',
            'frontpath'=>'require',
            'menu'=>'require|number',
            'icon'=>'require',
        ];
        protected $message = [
            'id'=> '请输入id code 1001',
            'page'=> '请添加页面 code 1002',
            'rule_id'=>'请选者上级菜单 code 1003',
            'name'=>'请填写名称 code 1004',
            'order'=>'请设置排序 code 1005',
            'method'=>'请填写邀请方式 code 1006',
            'condition'=>'请填写权限规则 code 1007',
            'frontpath'=>'请填写前段路由 code 1008',
            'menu'=>'选择菜单模式 code 1009',
            'icon'=>'添加图片 code 10010',
        ];

        protected $scene = [
            'index'=>['page'],
            'addRule'=>['rule_id','status','name','menu','order','method'],
            'updateRule'=>['id','rule_id','status','name','menu','order','method'],
            'deleteRule'=>['id'],
            'updateStatus'=>['id','status']
        ];
}