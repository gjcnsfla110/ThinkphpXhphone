<?php

namespace app\admin\controller;
use app\common\Base;
class Image extends Base
{
    public function save(){
        $param = $this->request->param();
        $data = $this->serviceM->saveImg($param);
        halt($data);
    }

    public function deleteImg(){

    }

    public function updateImg(){

    }
}