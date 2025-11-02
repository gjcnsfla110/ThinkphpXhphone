<?php

namespace app\app\validate;

class Usim extends BaseValidate
{

    protected $rule = [
        "id"=>"require|isModel",
    ];
    protected $message = [];
    protected $scene = [
        "usimDetail"=>["id"]
    ];
}