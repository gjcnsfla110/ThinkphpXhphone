<?php

namespace app\admin\excepthion\type;
use app\admin\excepthion\BaseException;

class LoginEx extends BaseException
{
    protected $errorCode = 1001;
    protected $statusCode = 404;
    protected $msg ="管理员系统错误联系客服";

}