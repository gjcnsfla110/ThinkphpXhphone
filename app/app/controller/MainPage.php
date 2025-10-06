<?php

namespace app\app\controller;

use app\common\Base;

class MainPage extends Base
{
    protected $noneValidateCheck =['index'];
    public function index(){
          $data = $this->serviceM->index();
          return showSuccess($data);
      }
}