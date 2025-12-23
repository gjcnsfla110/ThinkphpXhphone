<?php

namespace app\admin\model;
use app\admin\model\UsimCategory;

class Usim extends Model
{
    public function getUsimList($page,$limit,$where,$isCheck){
        if($isCheck < 2){
            $category =UsimCategory::select();
            $list = $this->page($page,$limit)->where($where)->select();
            return [
                'category'=>$category,
                'list'=>$list
            ];
        }else{
            $list = $this->page($page,$limit)->where($where)->select();
            return [
                'list'=>$list
            ];
        }
    }

    /**
     * @param $page
     * @param $limit
     * @param $where
     * @return array
     * 아이템을 전부보여주고 체크하여 서브메뉴 카테고리에 저장하기위해 검색하는 리스트 함수
     */
    public function checkItemsList($page,$limit,$where){
        $category =UsimCategory::select();
        $list = $this->page($page,$limit)->where($where)->order(['ranking'=>'desc','id'=>'desc'])->select();
        $total = $this->where($where)->count();
        return [
            'usimCategorys'=>$category,
            'list'=>$list,
            'total' => $total
        ];
    }
}