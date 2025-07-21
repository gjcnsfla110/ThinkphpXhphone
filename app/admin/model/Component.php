<?php

namespace app\admin\model;
use app\admin\model\ComponentName;
use app\admin\model\MainPage;

class Component extends BaseM
{
     public function getList($page, $limit, $where){
         $list = $this->page($page, $limit)->where($where)->order('id desc')->select();
         $total = $this->where($where)->count();
         $componentNames = ComponentName::select();
         $pages = MainPage::select();

         return ['list' => $list, 'total' => $total, 'pages' => $pages, 'componentNames' => $componentNames];
     }
}