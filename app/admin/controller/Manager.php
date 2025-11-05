<?php

namespace app\admin\controller;
use app\common\Base;
class Manager extends Base
{
    protected $noneValidateCheck=['getInfo','test'];
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
        $data = $this->serviceM->getInfo();
        return showSuccess($data);
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
         $params = $this->request->param();
         $data = $this->serviceM->addManager($params);
         return showSuccess($data);
    }

    public function updateManager(){
        $params = $this->request->param();
        $data = $this->serviceM->updateManager($params);
    }

    public function updateStatus(){
        $param = $this->request->param();
        $data = $this->serviceM->updateStatus($param);
        return showSuccess($data);
    }

    public function updatePass(){

    }

    public function superPassReset(){
        $id = input('id');
        return $this->serviceM->superPassReset($id);
    }
    public function deleteManager(){
        $data =$this->serviceM->deleteManager();
        return showSuccess($data);
    }

    public function test(){
        return password_hash("121314a", PASSWORD_BCRYPT);
    }
}