<?php

namespace app\admin\model;

class AgreementReview extends BaseM
{
    public  function getImgAttr($value){
        if (empty($value) || $value === null) {
            return [];
        }
        $data = json_decode($value, true);
        return is_array($data) ? $data : [];
    }

    public function getList($page,$limit,$where){
        $list = $this->page($page,$limit)->where($where)->order('id desc')->select();
        $total = $this->where($where)->count();
        return [
            'list'=>$list,
            'total'=>$total
        ];
    }
}