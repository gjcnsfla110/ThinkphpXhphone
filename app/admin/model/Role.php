<?php

namespace app\admin\model;

class Role extends BaseM
{
    public function rule(){
        return $this->belongsToMany('Role','role_rule');
    }

    public function managers(){
        return  $this->hasMany('Manager');
    }

    //매니저들의 role_id를 값을 0 만들기
    public function managerDefault($ids){
        request()->Model->managers()->whereIN('role_id',$ids)->update(['role_id'=>0]);
    }
    //role_rule테이블의 rule에관련된 데이터삭제
    public function deleteRules($ids){
        request()->Model->detach($ids);
    }

    public function list($page,$limit=10){
        $total = $this->count();
        $list = $this->with(['rule'=>function($m){
            $m->alias('a')->field('a.id');
        }])->page($page,$limit)->order('id','desc')->select();
        return ["total"=>$total,"list"=>$list];
    }

    protected static function onBeforeDelete($role){
        //매니저아이디
        $managerIds = $role->managers()->field('id')->select()->toArray();
        $role->managerDefault($managerIds);
        //메뉴를 삭제하는 부분
        $ruleIds = $role->rule()->field('id')->select()->toArray();
        if(count($ruleIds)) $role->deleteRules($ruleIds);
    }

}