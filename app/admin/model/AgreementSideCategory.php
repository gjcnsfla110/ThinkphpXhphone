<?php

namespace app\admin\model;

class AgreementSideCategory extends BaseM
{
    public function getSideCategoryList($page, $limit){
        $list = $this->page($page, $limit)->select()->toArray();
        $total = $this->count();
        return [
            'list' => $list,
            'total' => $total
        ];
    }
}