<?php

namespace app\admin\excepthion\type;
use app\admin\excepthion\BaseException;
use Throwable;

class LoginEx extends BaseException
{
    protected $errorCode = 1001;
    protected $statusCode = 404;

    public function __construct($message = "管理员系统错误联系客服"){
        $this->msg = $message;
    }
}