<?php

namespace app\app\model;
use app\admin\model\GoodsReview;
class Goods extends BaseM
{
    protected $json = ['service','banner','content','delivery','used_banner','used_banner_name','used_img','used_img_name'];
    protected $jsonAssoc = true;
    public function getSubMenuList($id,$page = 1,$limit = 10){
        $list = $this->where(['sideCategory_id'=>$id])->page($page,$limit)->order(['order'=>'desc','id'=>'desc'])->select();
        $total = $this->where(['sideCategory_id'=>$id])->count();
        return [
            'list'=>$list,'total'=>$total
        ];
    }

    public function getOneGoods($page = 1,$limit = 10,$id,$type = 1){
        if($type == 8){
            return request()->Model;
        }else{
            $item = request()->Model;
            $review = GoodsReview::page($page,$limit)->where(['goods_id'=>$id])->order('id','desc')->select();
            $total = GoodsReview::where(['goods_id'=>$id])->count();
            return [
                'item'=>$item,
                'review'=>$review,
                'total'=>$total
            ];
        }
    }
}