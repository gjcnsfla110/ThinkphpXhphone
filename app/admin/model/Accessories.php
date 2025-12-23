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

    /**
     * @param $page
     * @param $limit
     * @param $where
     * @return array
     * 아이템을 전부보여주고 체크하여 서브메뉴 카테고리에 저장하기위해 검색하는 리스트 함수
     */
    public function checkItemsList($page,$limit,$where){
        $goodsCategory = AccessoriesCategory::where('status',1)->select();
        $sideCategorys = AccessoriesSubCategory::select();
        $list = $this->page($page,$limit)->where($where)->order(['ranking'=>'desc','id'=>'desc'])->select();
        $total = $this->where($where)->count();
        return [
            'mainCategory'=>$goodsCategory,
            'sideCategory'=>$sideCategorys,
            'list'=>$list,
            'total' => $total
        ];
    }

}