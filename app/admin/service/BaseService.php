<?php

namespace app\admin\service;
use app\admin\excepthion\type\LoginEx;
use think\facade\Cache;
class BaseService
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
            foreach ($datas as $data){
                Cache::tag($data['tag'])->set($data['name'], $data['data'],$data['expire']);
            }
            echo Cache::get('manager_1');
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

    }

    /**
     * 토큰을 생성하는 함수
     * @return string
     */
    public function getToken(){
        // 生成token
        return  sha1(md5(uniqid(md5(microtime(true)),true)));
    }


}