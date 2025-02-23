<?php

namespace app\admin\model;
use app\common\BaseModel;

class BaseM extends BaseModel
{

    protected function getAllChildIds($id,$functionName,&$childids = []){
        $model = $this->find($id);
        if($model){
            $model->$functionName->each(function($item) use (&$childids,$functionName){
                $childids[] = $item->id;
                $item->getAllChildIds($item->id,$functionName,$childids);
            });
        }
        return $childids;
    }
}