<?php

namespace app\admin\service;
class ManagerService extends BaseService
{
    /**
     * 관리자 로그인 부분
     * @param $param
     * @return string
     * @throws \app\admin\excepthion\type\LoginEx
     */
     public function login($param){
         $data = getValueByKey('data',$param);
         if(empty($data)){
             ApiException("会员登录系统错误");
         }
         $tag = getValueByKey("tag",$param,"manager");
         $expire = getValueByKey("expire",$param,3600);
         $user = is_object($data) ? $data->toArray() : $data;
         $pass = getValueByKey("pass",$user);
         if($pass)unset($user['pass']);
         $token = $this->getTokenData($tag."_".$user['id']);
         if(!empty($token)){
             return $token;
         }
         $token = $this->getToken();
         $tokenName1 = $tag."_".$token;
         $tokenName2 = $tag."_".$user['id'];
         $this->setTokenData([
             [
                 'name'=>$tokenName1,
                 'data'=>$user,
                 'expire'=>$expire,
             ],
             [
                 'name'=>$tokenName2,
                 'data'=>$token,
                 'expire'=>$expire,
             ]
         ]);
        return $token;
     }

     public function logout($tokenName){
         $token = getValueByKey("token",$tokenName);
         $tag = getValueByKey("tag",$tokenName,"manager");
         $user = \think\facade\Cache::pull($tag."_".$token);
         if(!empty($user)){
             \think\facade\Cache::delete($tag."_".$user['id']);
         }
     }
}