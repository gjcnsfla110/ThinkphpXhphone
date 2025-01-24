<?php

namespace app\admin\service;
class ManagerService extends BaseService
{
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
         $token = $this->getToken();
         $tokenName1 = $tag."_".$token;
         $tokenName2 = $tag."_".$user['id'];
         $this->setTokenData([
             [
                 'name'=>$tokenName1,
                 'data'=>$user,
                 'expire'=>$expire,
                 'tag'=>$tag,
             ],
             [
                 'name'=>$tokenName2,
                 'data'=>$token,
                 'expire'=>$expire,
                 'tag'=>$tag,
             ]
         ]);
        return $token;
     }
}