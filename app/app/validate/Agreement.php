<?php

namespace app\app\validate;

class Agreement extends BaseValidate
{
     protected $rule = [
         "id"=>'require|isModel',
     ];
     protected $message = [];

     protected $scene = [
         'detailItem'=>['id'],
         'getPlans'=>['id']
     ];
}