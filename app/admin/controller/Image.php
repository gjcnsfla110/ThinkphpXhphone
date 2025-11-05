<?php

namespace app\admin\controller;
use app\common\Base;
class Image extends Base
{
    public function save(){
        $files = $this->request->file('files'); // files[] multiple 또는 단일 파일일 수도 있음
        if (!$files) {
            ApiException("没有上传图片");
        }

        // 배열로 통일
        if (!is_array($files)) {
            $files = [$files];
        }
        $category_id = input('image_class_id');
        $this->serviceM->saveImg($files, $category_id);
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