<?php

namespace app\admin\controller;
use app\common\Base;
class Image extends Base
{
    public function save(){
        $param = $this->request->param();
        $this->serviceM->saveImg($param);
        return showSuccess();
    }

    public function delete(){
        $param = $this->request->param();
        $data = $this->serviceM->deleteImg($param['ids']);
        return showSuccess($data);
    }

    public function update(){
        $param = $this->request->param();
        $data = $this->serviceM->updateImg($param);
        return showSuccess($data);
    }
}