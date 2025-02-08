<?php

namespace app\common;
class BaseS
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
            $appPath = __DIR__."/..";
            $filePath = $appPath."/{$root}/model/{$model}.php";
            if(file_exists($filePath)){
                $this->M = app("\\app\\{$root}\\model\\".$model);
            }else{
                ApiException("连接数据失败",2002);
            }
        }
    }
}