<?php

namespace app\admin\model;

class SubMenu extends BaseM
{
      public function getlist($page,$limit){
          $list = $this->page($page,$limit)->select();
          $count = $this->count();
          return [
              'list'=>$list,
              'total'=>$count
          ];
      }
}