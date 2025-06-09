<?php

namespace app\admin\validate;

class MainPage extends BaseValidate
{
    protected $rule = [
        "page"=>"require",
        "id"=>"require|isModel",
        "page_key"=>"require",
        "name"=>"require",
        "status"=>"require"
    ];
    protected $message = [

    ];
    protected $scene = [
        "index"=>["page"],
        "create"=>["page_key","name","status"],
        "update"=>["id","page_key","name","status"],
        "delete"=>["id"],
        "updateStatus"=>["id","status"]
    ];

}