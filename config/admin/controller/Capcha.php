<?php

namespace config\admin\controller;
use app\BaseController;
use think\captcha\facade\Captcha;

class Capcha extends BaseController
{
    public function getCaptcha(){
        return Captcha::create();
    }
}