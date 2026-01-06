<?php

namespace app\admin\model;
use app\admin\model\MainPage;

class Component extends BaseM
{
     public function getList($page, $limit, $where){
         $list = $this->page($page, $limit)->where($where)->order(['ranking'=>'desc','id'=>'desc'])->select();
         $total = $this->where($where)->count();
         $pages = MainPage::select();

         return ['list' => $list, 'total' => $total, 'pages' => $pages];
     }
}