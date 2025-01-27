<?php

namespace app\admin\validate;
class Manager extends BaseValidate
{
    protected $rule = [
        'manager_id' => "require|max:20",
        'username' => "require|max:20",
        'password' => "alphaDash",
    ];

    protected $scene = [
        'index'=>['page'],
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