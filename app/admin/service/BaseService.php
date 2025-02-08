<?php

namespace app\admin\service;
use app\admin\excepthion\type\LoginEx;
use app\common\BaseS;
use think\facade\Cache;

class BaseService extends BaseS
{
    /**
     * 토큰 기값에 데이터를 입력하는 함수
     * @param $data
     * @return void
     */
    public function setTokenData($datas){
        if(empty($datas)){
            return false;
        }
        try {
            foreach ($datas as $item){
                $name = getValueByKey("name",$item);
                $data = getValueByKey("data",$item);
                $expire = getValueByKey("expire",$item);
                $tag = getValueByKey("tag",$item,"manager");
                if($name&&$data&&$expire){
                    Cache::store(config("cmm.".$tag."token.store"))->set($name, $data,$expire);
                }
            }
        }catch(\think\Exception $e){
            throw new LoginEx($e->getMessage());
        }
    }

    /**
     * 토큰키값에 관련된 데이터를 갖고오는 함수
     * @param $data
     * @return void
     */
    public function getTokenData($data){
        return Cache::get($data);
    }

    /**
     * 토큰을 생성하는 함수
     * @return string
     */
    public function getToken(){
        // 生成token
        return  sha1(md5(uniqid(md5(microtime(true)),true)));
    }

    /**
     * 토큰 삭제 부분
     * @param $data
     * @return void
     */
    public function deleteToken($data){
        $token = getValueByKey("token",$data);
        $tag = getValueByKey("tag",$data,"manager");
        if(empty($token)){
            ApiException("非法登录");
        }
        $user = Cache::store(config("cmm.".$tag."token.store"))->pull($tag."_".$token);
        if(!empty($user))Cache::store(config("cmm.".$tag."token.store"))->pull($tag."_".$user["id"]);
    }
}