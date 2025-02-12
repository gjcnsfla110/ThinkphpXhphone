<?php

namespace app\admin\controller;
use app\common\Base;
class ImageClass extends Base
{
    protected $noneValidateCheck = ["all"];
    /**
     * 이미지 클래스 list모여주시
     * @return \think\response\Json
     */
    public function index(){
        $param = $this->request->param();
        $data = $this->serviceM->imageClassList($param);
        return showSuccess($data);
    }

    public function imagesList(){
        $param = $this->request->param();
        $data = $this->serviceM->imageList($param);
        return showSuccess($data);
    }

    /**
     * 이미지클래스 추가
     * @return void
     */
     public function save(){
         $data = $this->request->param();
         $this->serviceM->addImgClass($data);
     }

     public function delete(){

     }

     public function update(){

     }

     public function all(){
         $list = $this->serviceM->selectAllImgClass();
         return showSuccess($list);
     }
}