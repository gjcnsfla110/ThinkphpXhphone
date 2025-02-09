<?php

namespace app\admin\excepthion\type;
use app\admin\excepthion\BaseException;
class ValidateEx extends BaseException
{
    protected $errorCode = 1001;
    protected $statusCode = 405;
    protected $msg ="管理员系统错误联系客服 code:1001";
}