<?php

namespace app\admin\service;

class ImageClass extends BaseService
{

    public function imageClassList($data){
        return $this->M->Mlist($data);
    }
    /**
     * 이미지 클래스 추가
     * @param $data
     * @return void
     */
    public function addImgClass($data){
        $this->M->Mcreate($data);
    }
}