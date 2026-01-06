<?php

namespace app\admin\model;
use app\admin\model\Agreement;
use app\admin\model\Goods;
use app\admin\model\Usim;
use app\admin\model\Accessories;
use app\admin\model\SubMenuCategory;

class ComponentBanner extends Model
{
     public function getList($component_id){
          $list = $this->where('component_id',$component_id)->order(['ranking'=>'desc','id'=>'asc'])->select();
          return [
              'list' => $list,
          ];
     }

    public function getGoodsItem($id){
         $item = Goods::find($id);
         return ['item'=>$item];
    }

    public function getAgreementItem($id){
        $item = Agreement::find($id);
        return ['item'=>$item];
    }

    public function getUsimItem($id){
        $item = Usim::find($id);
        return ['item'=>$item];
    }

    public function getAccessoriesItem($id){
        $item = Accessories::find($id);
        return ['item'=>$item];
    }
    public function getCategoryItem($id){
        $item = SubMenuCategory::find($id);
        return ['item'=>$item];
    }
    public function getShopNewsItem($id){

    }

}