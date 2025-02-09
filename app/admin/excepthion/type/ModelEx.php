<?php

namespace app\admin\excepthion\type;
use app\admin\excepthion\BaseException;

class ModelEx extends BaseException
{
    protected $errorCode = 3001;
    protected $statusCode = 402;

    protected $msg ="管理员系统错误联系客服 code:3001";
}