<?php

namespace app\app\controller;

use app\common\Base;

class Accessories extends Base
{
    protected $noneValidateCheck = ['getSubCategoryList'];
    public function getSubCategoryList(){
        $id = input('subMenuId');
        $page = input('page');
        $limit = input('limit');
        $data = $this->serviceM->getSubCategoryList($id,$page,$limit);
        return showSuccess($data);
    }

    public function getItem(){
        $data = $this->serviceM->getItem();
        return showSuccess($data);
    }

    public function getReviewList(){
        $id = input('id');
        $page = input('page');
        $limit = input('limit');
        $data = $this->serviceM->getReviewList($id, $page, $limit);
        return showSuccess($data);
    }
}