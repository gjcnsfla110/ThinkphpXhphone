<?php

namespace app\admin\model;

class goodsCategory extends BaseM
{
    public function hasCategory(){
         return $this->hasMany('GoodsCategory','category_id');
    }

    private function deleteChild($ids){
        $this->whereIn('id',$ids)->delete();
    }
    public function getAll($page,$limit)
    {
        $menus = $this->page($page,$limit)->order('id','desc')->where('category_id',0)->select();
        $total = $this->count();
        $categorys = $this->MPselectAll();
        return [
            'list'=>$categorys,
            'menus'=>$menus,
            'total'=>$total,
        ];
    }

    protected static function onBeforeDelete($category){
         //자식아이디만 갖고오는 함수 getAllChildIds 중요점 static이므로 this 대신 변수 $category로 다른 함수를 실행시켜야합니다
         $childs_ids = $category->getAllChildIds($category->id,'hasCategory');
         $category->deleteChild($childs_ids);
    }
}