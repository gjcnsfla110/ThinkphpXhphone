<?php

namespace app\admin\model;
use app\admin\model\goodsCategory;
use app\admin\model\GoodsSubmenu;
class ComponentItem extends BaseM
{
     public function getList($id){
            $list = $this->order(['ranking'=>'desc','id'=>'desc'])->where('id',$id)->select();
            return [
                'list'=>$list
            ];
     }
    public function getGoodsList($page, $limit){
          $list = $this->order(['ranking'=>'desc','id'=>'desc'])->page($page, $limit)->where(['status',1])->select();
          $total = $this->where('status',1)->count();
          $mainMenu = goodsCategory::select()->toArray();
          $subMenu = GoodsSubmenu::select()->toArray();
          return [
              'list'=>$list,
              'total'=>$total,
              'mainMenu'=>$mainMenu,
              'subMenu'=>$subMenu
          ];
    }
}