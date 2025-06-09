<?php

namespace app\admin\model;

class MainPage extends BaseM
{
     public function getlist($page, $limit){
         $list = $this->page($page, $limit)->select();
         $total = $this->count();
         return [
             'list' => $list,
             'total' => $total
         ];
     }
}