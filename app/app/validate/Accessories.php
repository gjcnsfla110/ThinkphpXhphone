<?php

namespace app\app\validate;
class Accessories extends BaseValidate
{
    protected $rule = [
        'id'=>"require|isModel"
    ];

    protected $message = [];

    protected $scene = [
         'getItem'=>['id'],
         'getReviewList'=>['id']
    ];
}