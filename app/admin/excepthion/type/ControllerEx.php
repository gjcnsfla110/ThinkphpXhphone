<?php

namespace app\admin\excepthion\type;

use app\admin\excepthion\BaseException;

class ControllerEx extends BaseException
{
    protected $errorCode = 2001;
    protected $statusCode = 401;
    protected $msg ="管理员系统错误联系客服 code:2001";
}