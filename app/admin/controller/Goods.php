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
        $type = input('goodsType');
        $dataType = "";
        $data ="";
        if($type === 'old'){
            $dataType = "old";
            $this->isValidatePost = true;
            $param = $this->request->param();
            $used_img = $this->request->file('used_img');
            $used_banner = $this->request->file('used_banner');
            $data = $this->serviceM->add($param,$dataType,$used_img,$used_banner);
        }else{
            $dataType = "new";
            $param = request()->param();
            $data = $this->serviceM->add($param,$dataType);
        }
        return showSuccess($data);
    }
    public function update(){
        $type = input('goodsType');
        $dataType = "";
        $data ="";
        if($type === 'old'){
            $dataType = "old";
            $this->isValidatePost = true;
            $param = $this->request->param();
            $used_img = $this->request->file('used_img');
            $used_banner = $this->request->file('used_banner');
            $data = $this->serviceM->update($param,$dataType,$used_img,$used_banner);
        }else{
            $dataType = "new";
            $param = request()->param();
            $data = $this->serviceM->update($param,$dataType);
        }
        return showSuccess($data);
    }
    public function updateBanner(){
        $banner = input('banner');
        $data = $this->serviceM->updateBanner($banner);
        return showSuccess($data);
    }

    public function updateContent(){
        $content = input('content');
        $data = $this->serviceM->updateContent($content);
        return showSuccess($data);
    }

    public function updateStatus(){
        $status = input('status');
        $data = $this->serviceM->updateStatus($status);
        return showSuccess($data);
    }

    public function checkUpdateStatus(){
        $status = input('status');
        $ids = input('ids');
        $data = $this->serviceM->checkUpdateStatus($status, $ids);
    }

    public function delete(){
        $data = $this->serviceM->delete();
        return showSuccess($data);
    }

    public function deleteAll(){
        $ids = input('ids');
        $data = $this->serviceM->deleteAll($ids);
        return showSuccess($data);
    }

}