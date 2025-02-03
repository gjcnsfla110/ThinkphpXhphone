<?php

namespace app\admin\middleware;
use think\facade\Middleware;
use app\admin\service\BaseService;
class HasManagerToken extends Middleware
{
     public function handle($request, \Closure $next){
         $tag = "manager";
         $token = $request->header('token');
         if(empty($token)){
             return ApiException("非法token，请先登录！");
         }
         $service = new BaseService();
         $user = $service->getTokenData($tag."_".$token);
         if(empty($user)){
             return ApiException("非法token，请先登录！");
         }
         if(array_key_exists('password',$user)){
             unset($user['password']);
         }
         request()->UserModel = $user;
         return $next($request);
     }

}