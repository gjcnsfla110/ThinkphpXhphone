<?php

namespace app\admin\model;

class TitleMenu extends BaseM
{
    public  function getChildAttr($value){
        if (empty($value) || $value === null) {
            return [];
        }
        $data = json_decode($value, true);
        return is_array($data) ? $data : [];
    }
}