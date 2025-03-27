<?php

namespace app\admin\model;

class Model extends BaseM
{
     public function childModels(){
         return $this->hasMany('Model','pid','id');
     }

     private function delteChilds($ids){
         $this->whereIn('id',$ids)->delete();
     }

     public function getAll($page, $limit=10){
         $models = $this->page($page, $limit)->where('pid',0)->select();
         $list = $this->select();
         $total = $this->count();
         return [
             'models' => $models,
             'list' => $list,
             'total' => $total
         ];
     }

     protected static function onBeforeDelete($model){
         $ids = $model->getAllChildIds($model->id,'childModels');
         $model->delteChilds($ids);
     }
}