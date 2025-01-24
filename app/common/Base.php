<?php

namespace app\common;
use app\admin\excepthion\type\ValidateEx;
use app\BaseController;

class Base extends BaseController
{
    //자동모델객체를 생성할지여부 확인
    protected $autoNewModel = true;
    //수동모델 path 설정 가능 아래변수에 담기
    protected $ModelPath = null;
    //자동 검증을 할지여부를 체크
    protected $autoValidateCheck = true;
    //체크하지 않을 환경
    protected $noneValidateCheck = [];
    //내가 수동으로 체크할 환경변경
    protected  $autoValidateScenes =[];
    //자동생성한 모델을 담을 용기
    protected $M = null;
    //초기화후 request Data
    protected $Cinfo = [];

    /**
     * 초기화에서 모든 모델생성,또한 검증 validate 부분체크
     */
    protected function initialize(){
        $this->initControllerInfo();
        $this->initModel();
        $this->initValidateCheck();
    }
    /**
     * 자동화하기 위하여 현재,루트,컨트롤러,액션 등 값
     * @return void
     */
    private function initControllerInfo(){
        $this->Cinfo['root'] = str_replace('/','',request()->root());
        $this->Cinfo['controller'] = request()->controller();
        $this->Cinfo['action'] = request()->action();
    }

    /**
     * 모델 초기화 시작
     * @return void
     */
    private function initModel(){
        if(!$this->M && $this->autoNewModel){
            $model = $this->ModelPath ? $this->ModelPath : $this->Cinfo['controller'];
            $this->M = app("\\app\\{$this->Cinfo['root']}\\Model\\".$model);
        }
    }

    private function initValidateCheck(){
        define('APP_PATH',__DIR__."/..");
        if($this->autoValidateCheck && !in_array($this->Cinfo['action'],$this->noneValidateCheck)){
            $filePath = APP_PATH."/{$this->Cinfo['root']}/validate/{$this->Cinfo['controller']}.php";
            if(file_exists($filePath)){
                $scene = $this->Cinfo['action'];
                if(array_key_exists($scene,$this->autoValidateScenes)){
                    $scene = $this->autoValidateScenes[$scene];
                }
                $validate = app("\\app\\{$this->Cinfo['root']}\\validate\\{$this->Cinfo['controller']}");
                $param = $this->request->param();
                if(!$validate->scene($scene)->check($param)){
                    throw new ValidateEx($validate->getError());
                }
            }
        }

    }




}