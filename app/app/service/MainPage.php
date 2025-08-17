<?php

namespace app\app\service;

class MainPage extends BaseService
{
    public function index(){
        return $this->M->getMain();
    }
}