<?php

namespace app\admin\controller;
use app\common\Base;
use app\admin\service\ManagerService;
class Manager extends Base
{
    /**
     * 매니저로그인 부분
     * @return void
     */
    public function login(){
       $service = new ManagerService();
       $token = $service->login(['data'=>$this->request->UserModel]);
       return showSuccess(["token"=>$token]);
    }

    public function addM(){
        $data = $this->request->param();
        $pass1 = password_hash('121314a', PASSWORD_DEFAULT);

        $data = [
            'manager_id' => $data['manager_id'],
            'pass' => $pass1,
            'log_ip' =>$this->request->ip(),
            'last_time' =>date("Y-m-d H:i:s"),
            'status' => 1
        ];
        $this->M->where('id',1)->save($data);
    }
}