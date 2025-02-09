<?php

namespace app\admin\excepthion\type;
use app\admin\excepthion\BaseException;

class ServiceEx extends BaseException
{
    protected $errorCode = 4001;
    protected $statusCode = 403;
    protected $msg ="管理员系统错误联系客服 code:4001";
}