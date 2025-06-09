<?php

namespace app\admin\validate;
use think\Validate;

class BaseValidate extends Validate
{
    /**
     * 로그인 검증체크부분
     * @param $value
     * @param $rule
     * @param $data
     * @return string|true
     */
    public function checkLogin($value,$rule,$data){
        if(empty($value)) return "密码不能空";
        //값으로 넘어오는 설정을 받음 /0배열은 모델명/두번째부터는 함께조인할 모델명
        $arr = $arr = explode(',',$rule);
        if(!array_key_exists("manager_id",$data)) return "账号不能为空";
        if(empty($data['manager_id'])) return "账号不能为空";
        //현재 모델을 체크
        $model = $arr[0] ? "\\app\\admin\\model\\{$arr[0]}" : "\\app\\admin\\model\\".request()->controller();
        // 매니저아이디로 조건부합 모델을 갖고오기
        $user = count($arr) > 1 ? $model::where("manager_id",$data['manager_id'])->with($arr[1])->find() : $model::where("manager_id",$data['manager_id'])->find();
        if(empty($user)) return "账号错误";
        if (!password_verify($data['password'],$user->password)) {
            return '密码错误';
        }
        request()->UserModel = $user;
        return true;
    }

    protected function isModel($value,$rule,$data,$title="记录"){
        $arr = explode(',',$rule);
        if(empty($value)) return true;
        $model = !empty($arr[1]) ? "\\app\\admin\\model\\{$arr[1]}" : "\\app\\admin\\model\\".request()->controller();
        $M = $model :: find($value);
        if(!$M){
            return '该'.$title.'不存在';
        }
        if($arr[0] !=="false") request()->Model = $M;
        return true;
    }

    protected function parentModel($value,$rule,$data,$title="记录"){
        if($value === 0){
            return true;
        }
        $arr = explode(',',$rule);
        if(empty($value)) return true;
        $model = !empty($arr[1]) ? "\\app\\admin\\model\\{$arr[1]}" : "\\app\\admin\\model\\".request()->controller();
        $M = $model :: find($value);
        if(!$M){
            return '该'.$title.'不存在';
        }
        return true;
    }
}