<?php

namespace app\admin\controller;
use app\common\Base;
class ImageClass extends Base
{

    public function index(){
        $param = $this->request->param();
        $data = $this->serviceM->imageClassList($param);
        return showSuccess($data);
    }
    /**
     * 이미지클래스 추가
     * @return void
     */
     public function save(){
         $data = $this->request->param();
         try {
             $this->serviceM->addImgClass($data);
         }catch (\Exception $e){

         }

     }
}