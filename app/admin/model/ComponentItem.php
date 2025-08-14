<?php

namespace app\admin\model;
use app\admin\model\goodsCategory;
use app\admin\model\GoodsSubmenu;
use app\admin\model\Goods;
use app\admin\model\Model;
class ComponentItem extends BaseM
{
     public function getList($id){
            $list = $this->order(['ranking'=>'desc','id'=>'desc'])->where('component_id',$id)->select();
            return [
                'list'=>$list
            ];
     }
    public function getGoodsList($page,$isCheck, $limit=10, $where=[]){
          if($isCheck < 2){
              $list = Goods::page($page, $limit)->where(['status'=>1])->order(['order'=>'desc','id'=>'desc'])->select();
              $total = Goods::where('status',1)->count();
              $mainMenu = goodsCategory::select()->where('category_id',0)->toArray();
              $menuList = goodsCategory::select()->toArray();
              $subMenu = GoodsSubmenu::select()->toArray();
              $model = Model::where('status',1)->select();
              return [
                  'list'=>$list,
                  'total'=>$total,
                  'menuList' => $menuList,
                  'mainMenu'=>$mainMenu,
                  'subMenu'=>$subMenu,
                  'model'=>$model
              ];
          }else{
              $list = Goods::page($page,$limit)->where($where)->select();
              $total = Goods::where('status',1)->where($where)->count();
              return [
                  'list'=>$list,
                  'total'=>$total,
              ];
          }

    }
    public function allCreatItem($list){
         return $this->saveAll($list);
    }

    public function getGoods($goods_id){
        $goods = Goods::where('id',$goods_id)->select();
        return [
            'goods'=>$goods
        ];
    }
}