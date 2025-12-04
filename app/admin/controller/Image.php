<?php

namespace app\admin\controller;
use app\common\Base;
class Image extends Base
{
    public function save(){
        $files = $this->request->file('files'); // files[] multiple 또는 단일 파일일 수도 있음
        $category_id = input('image_class_id');
        $data = $this->serviceM->saveImg($files, $category_id);
        return showSuccess($data);
    }

    public function delete(){
        $data = $this->serviceM->deleteImg();
        return showSuccess($data);
    }

    public function update(){
        $original_name = input('original_name');
        $data = $this->serviceM->updateImg($original_name);
        return showSuccess($data);
    }

}