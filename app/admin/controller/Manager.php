<?php

namespace app\admin\controller;
use app\common\Base;
class Manager extends Base
{
    protected $noneValidateCheck=['test','getInfo'];
    /**
     * 매니저로그인 부분
     * @return void
     */
    public function login(){
       $token = $this->serviceM->login(['data'=>$this->request->UserModel]);
       return showSuccess(["token"=>$token]);
    }

    /**
     * 유저데이터를 주븐부분
     * @return void
     */
    public function getInfo(){
        return showSuccess(["menu"=>"aa"]);
    }

    public function logout(){
        try {
           $this->serviceM->logout(["token"=>$this->request->header('token')]);
        }catch (\Exception $e){
            return showError($e->getMessage());
        }
        return showSuccess();
    }

    public function getManagers(){
        $page = input('page');
        $limit = input('limit');
        $username = input('username');
        $data = $this->serviceM->getManagers($page, $limit, $username);
        return showSuccess($data);
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