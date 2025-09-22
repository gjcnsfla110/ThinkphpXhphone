<?php

namespace app\app\service;

class Goods extends BaseService
{
    public function getOneGoods(){
        return request()->Model;
    }
}