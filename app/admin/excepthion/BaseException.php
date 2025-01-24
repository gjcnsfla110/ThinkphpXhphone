<?php

namespace app\admin\excepthion;
use think\Exception;
class BaseException extends Exception
{
    protected $errorCode = 404;
    protected $statusCode = 501;
    protected $msg = '系统报错';
    public function __construct(string $message = "", int $statusCode = 0, int $errorCode = 404)
    {
        if($statusCode != 0){
            $this->statusCode = $statusCode;
        }
        if($message != ""){
            $this->msg = $message;
        }
        if($errorCode != 404){
            $this->errorCode = $errorCode;
        }
        parent::__construct();
    }

    public function getStatusCode(){
        return $this->statusCode;
    }
    public function ErrorJson(){
        return json(["msg"=>$this ->msg,"errorCode"=>$this->errorCode],$this->statusCode);
    }

}