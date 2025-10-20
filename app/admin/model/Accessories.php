<?php

namespace app\admin\model;
use app\admin\model\AccessoriesCategory;
use app\admin\model\AccessoriesSubCategory;
use app\admin\model\Label;
class Accessories extends BaseM
{
    public function getList($page,$isCheck, $limit=10, $where=[]){
        if($isCheck < 2){
            $categorys = AccessoriesCategory::where('status',1)->select();
            $label = Label::select();
            $sideCategorys = AccessoriesSubCategory::select();
            $list = $this->page($page,$limit)->where($where)->order(['ranking'=>'desc','id'=>'desc'])->select();
            $total = $this->where($where)->count();
            return [
                'categorys'=>$categorys,
                'label'=>$label,
                "sideCategorys"=>$sideCategorys,
                'list'=>$list,
                'total' => $total
            ];
        }else{
            $list = $this->page($page,$limit)->where($where)->order(['ranking'=>'desc','id'=>'desc'])->select();
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