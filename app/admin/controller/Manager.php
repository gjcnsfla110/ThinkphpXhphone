<?php

namespace app\admin\controller;
use app\common\Base;
use app\admin\service\ManagerService;
class Manager extends Base
{
    protected $noneValidateCheck=['test','getInfo','logout'];
    /**
     * 매니저로그인 부분
     * @return \think\response\Json
     */
    public function login(){
       $token = $this->service->login(['data'=>$this->request->UserModel]);
       return showSuccess(["token"=>$token]);
    }

    /**
     * 유저데이터를 주븐부분
     * @return \think\response\Json
     */
    public function getInfo(){
        return showSuccess(["menu"=>"aa"]);
    }

    public function logout(){
        try {
           $this->service->logout(["token"=>$this->request->header('token')]);
        }catch (\Exception $e){
            return showError($e->getMessage());
        }
        return showSuccess();
    }

    public function addM(){
        $data = $this->request->param();
        $pass1 = password_hash('1213a', PASSWORD_DEFAULT);

        $data = [
            'manager_id' => $data['manager_id'],
            'username' => $data['username'],
            'password' => $pass1,
            'login_ip' =>$this->request->ip(),
            'last_login' =>date("Y-m-d H:i:s"),
        ];
        $this->M->save($data);
    }

    public function test(){
            return 'a';
    }
}