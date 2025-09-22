<?php

namespace app\admin\model;
use app\admin\model\goodsCategory;
use app\admin\model\GoodsSpec;
use app\admin\model\Model;
use app\admin\model\GoodsColor;
use app\admin\model\Delivery;
use app\admin\model\Label;
use app\admin\model\Service;
use app\admin\model\GoodsSubmenu;
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
            $sideCategorys = GoodsSubmenu::select();
            $list = $this->page($page,$limit)->where($where)->order(['order'=>'desc','id'=>'desc'])->select();
            $total = $this->where($where)->count();

            return [
                'goodsCategory'=>$goodsCategory,
                'goodsSpec'=>$goodsSpec,
                'model'=>$model,
                'goodsColor'=>$goodsColor,
                'delivery'=>$delivery,
                'label'=>$label,
                'service'=>$service,
                "sideCategorys"=>$sideCategorys,
                'list'=>$list,
                'total' => $total
            ];
         }else{
             $list = $this->page($page,$limit)->where($where)->order(['order'=>'desc','id'=>'desc'])->select();
             $total = $this->where($where)->count();
            return [
                'list'=>$list,
                'total' => $total
            ];
         }
    }
    public function deleteAll($ids){
        return $this->whereIn('id',$ids)->delete();
    }

    public function checkUpdateStatus($status,$ids){
        return $this->whereIn('id',$ids)->update(['status'=>$status]);
    }
}