<?php

namespace app\admin\controller;

use app\common\Base;

class Goods extends Base
{
    public function index(){
        $param = request()->param();
        $data = $this->serviceM->index($param);
        return showSuccess($data);
    }
    public function add(){
        $param = request()->param();
        $data = $this->serviceM->add($param);
        return showSuccess($data);
    }
    public function update(){
        $param = request()->param();
        $data = $this->serviceM->update($param);
        return showSuccess($data);
    }
    public function updateBanner(){

    }
    public function updateStatus(){

    }

    public function checkUpdateStatus(){

    }

    public function delete(){

    }

    public function deleteAll(){

    }

}