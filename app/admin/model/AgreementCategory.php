<?php

namespace app\admin\model;

class AgreementCategory extends BaseM
{
    public function hasChild(){
        return $this->hasMany('AgreementCategory','pid','id');
    }

    protected function deleteChilds($ids){
        $this->whereIn('id',$ids)->delete();
    }

    public function getList($page,$limit){
        $listData = $this->page($page,$limit)->order(['ranking'=>'desc','id'=>'desc'])->where('pid',0)->select();
        $menuData = $this->MPselectAll()->toArray();
        $total = $this->count();
        return ([
            "list"=>$listData,
            "total"=>$total,
            "menus"=>$menuData,
        ]);
    }

    protected static function onBeforeDelete($rule){
        //자식rules 삭제하기
        $childIds =$rule->getAllChildIds($rule->id,'hasChild');
        $rule->deleteChilds($childIds);
    }
}