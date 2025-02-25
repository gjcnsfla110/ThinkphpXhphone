<?php

namespace app\admin\model;
use app\admin\model\Manager;
use app\admin\model\RoleRule;
class Role extends BaseM
{
    public function rule(){
        return $this->belongsToMany('Rule','role_rule');
    }

    public function managers(){
        return  $this->hasMany('Manager');
    }

    //매니저들의 role_id를 값을 0 만들기
    public function managerDefault(){
        $ids = request()->Model->managers()->field('id')->select()->toArray();
        Manager::whereIn('id',$ids)->update(['role_id'=>0]);
    }
    //role_rule테이블의 rule에관련된 데이터삭제
    public function deleteRules($ids){
        request()->Model->detach($ids);
    }

    public function updateRules($id,$ruleIds){
        $ids = RoleRule::where(['role_id'=>$id])->column('rule_id');
        //아래에서는 추가,삭제부분
        $addIds = array_diff($ruleIds,$ids);
        $deleteIds = array_diff($ids,$ruleIds);
        //추가된 부분을 추가
        if(count($addIds) > 0){
            request()->Model->rule()->attach($addIds);
        }
        //삭제할 부분을 삭제
        if(count($deleteIds) > 0){
            request()->Model->rule()->detach($deleteIds);
        }

        return true;
    }
    public function list($page,$limit=10){
        $total = $this->count();
        $list = $this->with(['rule'=>function($m){
            $m->alias('a')
                ->field('a.id') // pivot.rule_id를 명확히 지정
                ->hidden(['pivot']);
        }])->page($page,$limit)->order('id','desc')->select()->toArray();
        foreach ($list as &$item) {
            $item['rule'] = array_column($item['rule'], 'id');
        }
        return ["total"=>$total,"list"=>$list];
    }

    protected static function onBeforeDelete($role){
        //매니저아이디
        $role->managerDefault();
        //메뉴를 삭제하는 부분
        $ruleIds = $role->rule()->alias('a')->field('a.id')->select()->toArray();
        if(count($ruleIds)) $role->deleteRules($ruleIds);
    }

}