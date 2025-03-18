<?php

namespace app\admin\model;

class Rule extends BaseM
{
    public function Role(){
        return $this->belongsToMany('Role','role_rule');
    }

    protected function deleteRoles($ids){
        $this->Role()->detach($ids);
    }

    protected function deleteChilds($ids){
        $this->whereIn('id',$ids)->delete();
    }

    public function hasChild(){
        return $this->hasMany('Rule');
    }
    public function Mlist($page,$limit=10){
        $listData = $this->page($page,$limit)->order(['order'=>'desc','id'=>'desc'])->where('rule_id',0)->select();
        $menuData = $this->MPselectAll()->toArray();
        $total = $this->count();
        $list = $this->list_to_tree2($listData->toArray(),'rule_id','child',0);
        return ([
            "list"=>$list,
            "total"=>$total,
            "menus"=>$menuData,
        ]);
    }

    public function MupdateStatus($id,$status){
        return $this->where('id',$id)->update(['status'=>$status]);
    }

    public function allData(){
        return $this->order(['order'=>'desc','id'=>'desc'])->select();
    }

    protected static function onBeforeDelete($rule){
        //删除外链关系role_rule数据表
        $roleIds = array_map(function($item){
            return $item['id'];
        },$rule->Role()->select()->toArray());
        $rule->deleteRoles($roleIds);

        //자식rules 삭제하기
        $childIds =$rule->getAllChildIds($rule->id,'hasChild');
        $rule->deleteChilds($childIds);
    }
}