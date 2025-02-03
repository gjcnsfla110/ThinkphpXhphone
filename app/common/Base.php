<?php

namespace app\common;
use app\admin\excepthion\type\ValidateEx;
use app\BaseController;

class Base extends BaseController
{

    //자동 검증을 할지여부를 체크
    protected $autoValidateCheck = true;
    //체크하지 않을 환경
    protected $noneValidateCheck = [];
    //내가 수동으로 체크할 환경변경
    protected  $autoValidateScenes =[];

    //초기화후 request Data
    protected $Cinfo = [];

    //service 값
    protected $serviceName =null;
    //service 자동초기화 여부
    protected $autoService = true;
    //service 모델 초기화
    protected $serviceM = null;

    /**
     * 초기화에서 모든 모델생성,또한 검증 validate 부분체크
     */
    protected function initialize(){
        $this->initControllerInfo();
        $this->initValidateCheck();
        $this->initService();
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
     * 自动生成Service
     * @return void
     */
    private  function initSerVice(){
        if(!$this->serviceName && $this->autoService){
            $service = $this->serviceM ? $this->serviceM : $this->Cinfo['controller'];
            $filePath = APP_PATH."/{$this->Cinfo['root']}/service/{$service}.php";
            if(file_exists($filePath)){
                $this->serviceM = app("\\app\\{$this->Cinfo['root']}\\service\\".$service);
            }else{
                ApiException("连接服务失败",2001);
            }
        }
    }

    /**
     * 自动生成验证
     * @return void
     * @throws ValidateEx
     */
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
                if(!$validate->scene($scene)->check($param)) {
                    throw new ValidateEx($validate->getError());
                }
            }
        }

    }




}