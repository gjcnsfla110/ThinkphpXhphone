<?php

namespace app\app\model;

use app\admin\model\AccessoriesReview;

class Accessories extends BaseM
{
    public function getSubCategoryList($id,$page = 1,$limit = 10){
        $list = $this->where(['sideCategory_id'=>$id])->page($page,$limit)->order(['ranking'=>'desc','id'=>'desc'])->select();
        $total = $this->where(['sideCategory_id'=>$id])->count();
        return [
            'list'=>$list,
            'total'=>$total
        ];
    }

    public function getReviewList($id, $page = 1, $limit = 10){
        $review = AccessoriesReview::page($page,$limit)->where(['accessories_id'=>$id])->order('id','desc')->select();
        $total = AccessoriesReview::where(['accessories_id'=>$id])->count();
        return [
            'reviews' => $review,
            'total' => $total
        ];
    }
}