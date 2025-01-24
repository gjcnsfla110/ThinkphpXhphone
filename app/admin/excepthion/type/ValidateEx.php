<?php

namespace app\admin\excepthion\type;
use app\admin\excepthion\BaseException;
class ValidateEx extends BaseException
{
    protected $errorCode = 2001;

    public function __construct($msg="验证问题出错误")
    {
       $this->msg = $msg;
    }
}