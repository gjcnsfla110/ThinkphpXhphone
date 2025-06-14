<?php

namespace app\admin\model;
use app\admin\model\AgreementCategory;
class AgreementSideCategory extends BaseM
{
    public function getSideCategoryList($page, $limit,$where){
        $list = $this->page($page, $limit)->where($where)->select()->toArray();
        $menus = AgreementCategory::select();
        $total = $this->count();
        return [
            'list' => $list,
            'menus' => $menus,
            'total' => $total
        ];
    }
}