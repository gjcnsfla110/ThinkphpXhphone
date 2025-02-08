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
         halt($user);
         $request->UserModel = $model::find($user['id']);
         if($request->UserModel->status){
             return ApiException("当前用户已被禁用");
         }
         $request->userInfo = $user;
         return $next($request);
     }

}