<?php

namespace app\admin\model;
use app\admin\model\SubMenuCategory;

class SubMenu extends BaseM
{
      public function getlist($page,$limit){
          $list = $this->page($page,$limit)->order(['ranking'=>'desc','id'=>'desc'])->select();
          $subMenuCategorys = SubMenuCategory::select();
          $count = $this->count();
          return [
              'subMenuCategorys'=>$subMenuCategorys,
              'list'=>$list,
              'total'=>$count
          ];
      }
}