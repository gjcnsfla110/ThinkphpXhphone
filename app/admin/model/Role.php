<?php

namespace app\admin\model;

class Role extends BaseM
{
    public function Rule(){
        return $this->belongsToMany('Role','role_rule');
    }

    public function managers(){
        return  $this->hasMany('Manager');
    }

    //매니저들의 role_id를 값을 0 만들기
    public function managerDefault($ids){

    }
    //role_rule테이블의 rule에관련된 데이터삭제
    public function deleteRules(){

    }

    public function list($page,$limit=10){
        $total = $this->count();
        $list = $this->with(['Rule'=>function($m){
            $m->alias('a')->field('a.id');
        }])->page($page,$limit)->order('id','desc')->select();
        return ["total"=>$total,"list"=>$list];
    }

    protected static function onBeforeDelete($role){

        return false;
    }

}