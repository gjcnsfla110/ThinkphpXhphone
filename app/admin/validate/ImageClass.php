<?php

namespace app\admin\validate;

class ImageClass extends BaseValidate
{
    protected $rule=[
        'id'=> 'require|integer|>:0|isModel',
        'page'=> 'require|integer|>:0',
        'pid' => 'require|integer|>=:0',
         'name' => 'require|',
         'order'=>'require|integer|>=:0'
    ];

    protected $message=[
         "id"=>"输入错误 code 1001",
         'page' => "没有邀请页，系统出错",
         'pid' => "输入错误 code 1003",
         'name'=>  "填写图片类名称",
         'order' => "填写排序优先级别"
    ];
    protected $scene=[
        "save" => ["pid","name","order"],
    ];
}