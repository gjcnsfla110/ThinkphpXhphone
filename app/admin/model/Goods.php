<?php

namespace app\admin\model;
use app\admin\model\goodsCategory;
use app\admin\model\GoodsSpec;
use app\admin\model\Model;
use app\admin\model\GoodsColor;
use app\admin\model\Delivery;
use app\admin\model\Label;
use app\admin\model\Service;
class Goods extends BaseM
{
    public function getList($page,$isCheck, $limit=10, $where=[]){
         if($isCheck < 2){
            $goodsCategory = goodsCategory::where('status',1)->select();
            $goodsSpec = GoodsSpec::field('id,spec_id,name,spec_menu,model')->where('status',1)->select();
            $model = Model::where('status',1)->select();
            $goodsColor = GoodsColor::select();
            $delivery = Delivery::select();
            $label = Label::select();
            $service = Service::select();
            $list = $this->page($page,$limit)->where($where)->select();

            return [
                'goodsCategory'=>$goodsCategory,
                'goodsSpec'=>$goodsSpec,
                'model'=>$model,
                'goodsColor'=>$goodsColor,
                'delivery'=>$delivery,
                'label'=>$label,
                'service'=>$service,
                'list'=>$list
            ];
         }else{
             $list = $this->page($page,$limit)->where($where)->select();
            return [
              'list'=>$list
            ];
         }
    }
}