<?php

namespace app\admin\model;

class ShopCategory extends BaseM
{
    public function hasCategory(){
        return $this->hasMany('ShopCategory','pid');
    }

    private function deleteChild($ids){
        $this->whereIn('id',$ids)->delete();
    }

    public function getCategoryList($page, $limit){
        $menus = $this->page($page,$limit)->order(['ranking'=>"desc","id"=>"desc"])->where('pid',0)->select();
        $list = $this->select();
        $count = $this->count();
        return [
            'list' => $list,
            'total'=>$count,
            'menus'=>$menus,
        ];
    }

    protected static function onBeforeDelete($category){
        //자식아이디만 갖고오는 함수 getAllChildIds 중요점 static이므로 this 대신 변수 $category로 다른 함수를 실행시켜야합니다
        $childs_ids = $category->getAllChildIds($category->id,'hasCategory');
        $category->deleteChild($childs_ids);
    }
}