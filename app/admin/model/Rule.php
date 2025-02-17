<?php

namespace app\admin\model;

class Rule extends BaseM
{
    public function Role(){
        return $this->belongsToMany('Role','role_rule');
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

    public function Mupdate($id,$data){
         return $this->where('id',$id)->save($data);
    }

    public function MupdateStatus($id,$status){
        return $this->where('id',$id)->update(['status'=>$status]);
    }
}