<?php

namespace app\admin\model;
use app\admin\model\goodsCategory;
use app\admin\model\GoodsSubmenu;
use app\admin\model\Goods;
class ComponentItem extends BaseM
{
     public function getList($id){
            $list = $this->order(['ranking'=>'desc','id'=>'desc'])->where('id',$id)->select();
            return [
                'list'=>$list
            ];
     }
    public function getGoodsList($page, $limit){
          $list = Goods::page($page, $limit)->where(['status'=>1])->order(['order'=>'desc','id'=>'desc'])->select();
          $total = Goods::where('status',1)->count();
          $mainMenu = goodsCategory::select()->where('category_id',0)->toArray();
          $menuList = goodsCategory::select()->toArray();
          $subMenu = GoodsSubmenu::select()->toArray();
          return [
              'list'=>$list,
              'total'=>$total,
              'menuList' => $menuList,
              'mainMenu'=>$mainMenu,
              'subMenu'=>$subMenu
          ];
    }
}