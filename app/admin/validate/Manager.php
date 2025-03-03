<?php

namespace app\admin\validate;
class Manager extends BaseValidate
{
    protected $rule = [
        'id'=>'require|integer|isModel',
        'manager_id' => "require|max:20|unique:manager",
        'username' => "require|max:20",
        'password' => "require|max:30",
        'phone'=>'require|max:20',
        'role_id'=>'require|integer|isModel:false,Role',
        'status'=>'require',
    ];

    protected $scene = [
        'getManagers'=>['page'],
        'addManager'=>['username','password','manager_id','role_id','phone','status'],
        'updateStatus'=>['id','status'],
        'updateManager'=>['id'],
        'deleteManager'=>['id'],
        'superPassReset'=>['id']
    ];
    /**
     * 로그인시 체크하기 함수
     * @param $value
     * @param $rule
     * @param $data
     * @return string|void
     */
    public function sceneLogin(){
        return $this->only(['password'])
                    ->append('password', 'checkLogin');
    }
}