<?php

namespace app\admin\validate;

class PageBanner extends BaseValidate
{
        protected $rule = [
            "page"=>"require",
             "id"=>"require|isModel",
             "img"=>"require",
             "link"=>"require",
             "status"=>"require",
             "ranking"=>"require"

        ];

        protected $message = [

        ];

        protected $scene = [
            "index"=>['page'],
            "create"=>['img','link','status','ranking'],
            "update"=>['id','img','link','status','ranking'],
            "delete"=>['id'],
            "updateStatus"=>['id','status']
        ];
}