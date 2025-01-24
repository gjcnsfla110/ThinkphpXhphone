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
       $token = ManagerService::class->login(['data'=>$this->request->UserModel]);
    }
}