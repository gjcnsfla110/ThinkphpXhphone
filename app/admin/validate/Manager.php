<?php

namespace app\admin\validate;
class Manager extends BaseValidate
{
    protected $rule = [
        'manager_id' => "require|max:20",
        'pass' => "alphaDash",
    ];

    protected $scene=[

    ];
    /**
     * 로그인시 체크하기 함수
     * @param $value
     * @param $rule
     * @param $data
     * @return string|void
     */
    public function sceneLogin(){
        return $this->only(['manager_id','pass'])
                    ->append('pass', 'checkLogin');
    }
}