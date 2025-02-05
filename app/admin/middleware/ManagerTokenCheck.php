<?php

namespace app\admin\middleware;
use think\facade\Middleware;
use app\admin\service\BaseService;
class ManagerTokenCheck extends Middleware
{
    public function handle($request, \Closure $next){
         $token = $request->header('token');
         if(empty($token)){
             return ApiException("非法token，请先登录！");
         }

    }
}