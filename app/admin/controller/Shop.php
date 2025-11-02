<?php

namespace app\admin\controller;

use app\common\Base;

class Shop extends Base
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

    public function updateShopImg(){
        $shopImg = input('shopImg');
        $data = $this->serviceM->updateBanner($shopImg);
        return showSuccess($data);
    }


    public function updateStatus(){
        $status = input('status');
        $data = $this->serviceM->updateStatus($status);
        return showSuccess($data);
    }

    public function delete(){
        $data = $this->serviceM->delete();
        return showSuccess($data);
    }

}