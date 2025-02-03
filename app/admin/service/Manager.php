<?php

namespace app\admin\service;
class Manager extends BaseService
{
    //자동모델객체를 생성할지여부 확인
    protected $autoNewModel = true;

    //수동모델 path 설정 가능 아래변수에 담기
    protected $ModelPath = null;

    //자동생성한 모델을 담을 용기
    protected $M = null;

    public function __construct(){
        if(!$this->M && $this->autoNewModel){
            $root = str_replace('/','',request()->root());
            $model = $this->ModelPath ? $this->ModelPath : request()->controller();
            $filePath = APP_PATH."/{$root}/model/{$model}.php";
            if(file_exists($filePath)){
                $this->M = app("\\app\\{$root}\\model\\".$model);
            }else{
                ApiException("连接数据失败",2002);
            }
        }
    }

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
}