<?php

namespace app\admin\model;

class Rule extends BaseM
{
    public function role(){
        return $this->belongsToMany('Role','role_rule');
    }

    public function deleteRoles($ids){
        return $this->Role()->detach($ids);
    }

    public function hasChild(){
        return $this->hasMany('Rule');
    }
    public function Mlist($page,$limit=10){
        $listData = $this->page($page,$limit)->order(['order'=>"desc",'id'=>'desc'])->select();
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

    public static function onBeforeDelete($rule){
        //删除外链关系role_rule数据表
        $roleIds = array_map(function($item){
            return $item['id'];
        },$rule->role()->select()->toArray());
        $rule->deleteRoles($roleIds);

        //자식rules 삭제하기
        $childIds = array_map(function($item){
            return $item['id'];
        },$rule->hasChild()->select()->toArray());
        $rule->destroy($childIds);
    }
}