<?php

namespace app\admin\controller;
use app\common\Base;
class ImageClass extends Base
{

    /**
     * 이미지클래스 추가
     * @return void
     */
     public function save(){
         $this->serviceM->addImgClass();
     }
}