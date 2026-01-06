<?php

namespace app\admin\model;
use app\admin\model\Goods;
use app\admin\model\Accessories;
use app\admin\model\Agreement;
use app\admin\model\Usim;
class ComponentItem extends BaseM
{
     public function getList($id){
            $list = $this->order(['ranking'=>'desc','id'=>'desc'])->where('component_id',$id)->select();
            return [
                'list'=>$list
            ];
     }

    public function allCreatItem($list){
         return $this->saveAll($list);
    }

    public function getGoods($itemId){
        return Goods::find($itemId);
    }

    public function getAccessories($itemId){
        return Accessories::find($itemId);
    }

    public function getAgreement($itemId){
        return Agreement::find($itemId);
    }

    public function getUsim($itemId){
        return usim::find($itemId);
    }

}