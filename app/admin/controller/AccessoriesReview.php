<?php

namespace app\admin\controller;

use app\common\Base;

class AccessoriesReview extends Base
{
    public function index(){
        $param = $this->request->param();
        $data = $this->serviceM->index($param);
        return showSuccess($data);
    }

    public function add(){
        $this->isValidatePost = true;
        $accessories_id = input('accessories_id');
        $type = input('type');
        $title = input('title');
        $video = input('video');
        $date = input('date');
        $files = $this->request->file('files');
        $data = $this->serviceM->add($accessories_id, $type, $title, $video, $date,$files);
        return showSuccess($data);
    }

    public function delete(){
        $data = $this->serviceM->delete();
        return showSuccess($data);
    }

}