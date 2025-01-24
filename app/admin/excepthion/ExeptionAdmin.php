<?php

namespace app\admin\excepthion;
use think\exception\Handle;
use think\exception\HttpException;
use think\exception\ValidateException;
use app\admin\excepthion\BaseException;
use think\Response;
use Throwable;
class ExeptionAdmin extends Handle
{
    public function render($request, Throwable $e): Response{
        //자체 예외처리 부분
        if($e instanceof BaseException){
            return $e->ErrorJson();
        }
        // 参数验证错误
        if ($e instanceof ValidateException) {
            return json($e->getError(), 422);
        }

        // 请求异常
        if ($e instanceof HttpException && $request->isAjax()) {
            return response($e->getMessage(), $e->getStatusCode());
        }
        // 其他错误交给系统处理
        return parent::render($request, $e);
    }
}