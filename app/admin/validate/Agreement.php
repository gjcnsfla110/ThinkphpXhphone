<?php

namespace app\admin\validate;

class Agreement extends BaseValidate
{
        protected $rule = [
            "page"=>'require',
            "id"=>'require|isModel',
            "sideCategory_id"=>'require',
            "planCategory_id"=>'require',
            "mobile"=>'require',
            "title"=>'require',
            "detail"=>'require',
            "content"=>'require',
            "color"=>'require',
            "img"=>'require',
            "banner"=>'require',
            "price"=>'require',
            "sale_price"=>'require',
            "status"=>'require',
            "ranking"=>'require'
        ];

        protected $message = [];

        protected $scene = [
             "index"=>['page'],
             "create"=>['sideCategory_id','title','detail','content','color','img','banner','price','sale_price','status','ranking','planCategory_id','mobile'],
             "update"=>['id','sideCategory_id','title','detail','content','color','img','banner','price','sale_price','status','ranking','planCategory_id','mobile'],
             "delete"=>['id'],
             "updateStatus"=>['id','status'],
             "itemDetail"=>['id'],
             "updateBanner"=>['id','banner']
        ];

}