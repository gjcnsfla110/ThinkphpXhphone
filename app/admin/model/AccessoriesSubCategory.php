<?php

namespace app\admin\model;
use app\admin\model\AccessoriesCategory;
class AccessoriesSubCategory extends BaseM
{
    public function getList($page,$limit,$where){
        $menus = AccessoriesCategory::where('status',1)->select();
        $list = $this->page($page,$limit)->where($where)->order(['ranking'=>'desc','id'=>'desc'])->select();
        $total = $this->where($where)->count();
        return [
            'menus'=>$menus,
            'list' => $list,
            'total' => $total
        ];
    }
}