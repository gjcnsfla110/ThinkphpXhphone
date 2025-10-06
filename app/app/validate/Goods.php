<?php

namespace app\app\validate;

class Goods extends BaseValidate
{
     protected $rule = [
         "id"=>'require|isModel'
     ];
     protected $message = [];
     protected $scene = [
         'getOneGoods'=>['id']
     ];
}