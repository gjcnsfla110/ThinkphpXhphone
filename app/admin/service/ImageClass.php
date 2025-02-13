<?php

namespace app\admin\service;
class ImageClass extends BaseService
{
    /**
     * 이미지 클래스 리스트
     * @param $data
     * @return mixed
     */
    public function imageClassList($data){
        return $this->M->Mlist($data);
    }

    public function imageList($data){
        return $this->M->MimgList($data);
    }

    /**
     * 이미지 클래스 추가
     * @param $data
     * @return void
     */
    public function addImgClass($data){
        $this->M->Mcreate($data);
    }

    public function deleteImgClass($id){
        $this->M->Mdelete($id);
    }

    public function updateImgClass($data){
        $this->M->Mupdate($data);
    }

    public function selectAllImgClass(){
        return $this->M->MselectAll();
    }

}