<?php

namespace app\admin\validate;

class AgreementCategory extends BaseValidate
{
        protected $rule = [
            'id'=>"require|isModel",
            'page'=>"require",
            'name'=>'require',
            'status'=>'require',
            'hot'=>'require',
            'ranking'=>'require'
        ];

        protected $message = [

        ];

        protected $scene = [
            'index'=>['page'],
            'create'=>['name','status','hot','ranking'],
            'update'=>['id','name','status','hot','ranking'],
            'updateStatus'=>['id','status'],
            'updateHot'=>['id','hot'],
            'delete'=>['id']
        ];
}