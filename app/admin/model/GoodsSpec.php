<?php

namespace app\admin\model;

class GoodsSpec extends BaseM
{
     public function childs(){
         return $this->hasMany('GoodsSpec','spec_id','id');
     }

     public function deleteChild($ids){
         $this->WhereIn('id',$ids)->delete();
     }

     public function getAll($page,$limit=10){
          $list = $this->select();
          $menus = $this->page($page,$limit)->where('spec_id',0)->select();
          $total = $this->count();
          return ['list'=>$list,'menus'=>$menus,'total'=>$total];
     }

    protected static function onBeforeDelete($spec){
        //자식아이디만 갖고오는 함수 getAllChildIds 중요점 static이므로 this 대신 변수 $category로 다른 함수를 실행시켜야합니다
        $childs_ids = $spec->getAllChildIds($spec->id,'childs');
        $spec->deleteChild($childs_ids);
    }
}