<?php

namespace app\admin\model;

class Rule extends BaseM
{
    public function Role(){
        return $this->belongsToMany('Role','role_rule');
    }

    public function deleteRoles($ids){
        return $this->Role()->detach($ids);
    }

    public function hasChild(){
        return $this->hasMany('Rule');
    }
    public function Mlist($page,$limit=10){
        $listData = $this->page($page,$limit)->order('id','desc')->select();
        $menuData = $this->MPselectAll();
        $total = $this->count();
        $list = $this->list_to_tree2($listData->toArray(),'rule_id','child',0);
        $menus = $this->listChild($menuData->toArray(),'rule_id','child',0);
        return ([
            "list"=>$list,
            "total"=>$total,
            "menus"=>$menus,
        ]);
    }

    public function MupdateStatus($id,$status){
        return $this->where('id',$id)->update(['status'=>$status]);
    }

    public function onBeforeDelete($rule){
         halt("들어옴");
        //删除外链关系role_rule数据表
        $roleIds = array_map(function($item){
            return $item['id'];
        },$rule->Role()->toArray());
        $this->deleteRoles($roleIds);

        //자식rules 삭제하기
        $childIds = array_map(function($item){
            return $item['id'];
        },$rule->hasChild()->toArray());
        $this->destroy($childIds);
    }
}