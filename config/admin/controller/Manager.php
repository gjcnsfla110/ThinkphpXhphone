<?php

namespace config\admin\controller;
use app\BaseController;

class Manager extends BaseController
{
    public function login(){
        $code = $this->request->param();
        dump($code);
        return json(["msg"=>$code],200);

    }
}