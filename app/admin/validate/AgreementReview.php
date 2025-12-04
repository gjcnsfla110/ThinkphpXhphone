<?php

namespace app\admin\validate;

class AgreementReview extends BaseValidate
{
    protected $rule = [
        'page' => 'require',
        'id'=>'require|isModel',
        'agreement_id'=>'require',
        'type'=>'require',
        'title'=>'require',
    ];

    protected $message = [];

    protected $scene = [
        'index'=>['page'],
        'add'=>['agreement_id','type','title'],
        'delete'=>['id'],
    ];
}