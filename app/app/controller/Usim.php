<?php

namespace app\app\controller;
use app\common\Base;

class Usim extends Base
{
    protected $noneValidateCheck = ["usimList"];
    public function usimList(){
        $data = $this->serviceM->usimList();
        return showSuccess($data);
    }

    public function usimDetail(){

    }
}