<?php

namespace app\admin\service;

class Manager extends BaseService
{

    /**
     * 로그인 토큰 저장부분
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
                 'tag'=>$user['manager_id'],
             ],
             [
                 'name'=>$tokenName2,
                 'data'=>$token,
                 'expire'=>$expire,
                 'tag'=>$user['manager_id'],
             ]
         ]);
        return $token;
     }

     public function logout($data){
         $this->deleteToken($data);
     }


    public function getManagers($page, $limit, $username){
        return $this->M->getManagers($page, $limit, $username);
    }

    public function addManager(){

    }

    public function updateManager(){

    }

    public function updateStatus(){

    }

    public function updatePass(){

    }
    public function superPassReset(){

    }
    public function deleteManager(){

    }
}