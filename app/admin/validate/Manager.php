<?php

namespace app\admin\validate;
class Manager extends BaseValidate
{
    protected $rule = [
        'manager_id' => "require|max:20|NotEmpty|unique:manager",
        'username' => "require|max:20",
        'password' => "require|max:30",
        'phone'=>'require|max:20',
        'role_id'=>'require|NotEmpty',
    ];

    protected $scene = [
        'getManagers'=>['page'],
        'addManager'=>['username','password','manager_id'],
    ];
    /**
     * 로그인시 체크하기 함수
     * @param $value
     * @param $rule
     * @param $data
     * @return string|void
     */
    public function sceneLogin(){
        return $this->only(['manager_id','password'])
                    ->append('password', 'checkLogin');
    }
}