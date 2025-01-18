<?php

namespace app\admin\controller;
use think\captcha\facade\Captcha;
class Capcha
{
    public function getCaptcha(){
        return Captcha::create();
    }
}