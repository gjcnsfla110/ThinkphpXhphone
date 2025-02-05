<?php

namespace app\admin\controller;
use app\common\Base;
class Manager extends Base
{
    protected $noneValidateCheck=['test','getInfo','logout'];
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
        return showSuccess("aaa");
    }


    public function logOut(){
        $this->serviceM->logOut();
        return showSuccess("退出登录成功");
    }


    public function addM(){
        $data = $this->request->param();
        $pass1 = password_hash('121314a', PASSWORD_DEFAULT);

        $data = [
            'manager_id' => $data['manager_id'],
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