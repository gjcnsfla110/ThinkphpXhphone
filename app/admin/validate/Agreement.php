<?php

namespace app\admin\validate;

class Agreement extends BaseValidate
{
        protected $rule = [
            "page"=>'require',
            "id"=>'require|isModel',
            "category_id"=>'require',
            "sideCategory_id"=>'require',
            "planCategory_id"=>'require',
            "mobile"=>'require',
            "title"=>'require',
            "detail"=>'require',
            "img"=>'require',
            "banner"=>'require',
            "price"=>'require',
            "sale_price"=>'require',
            "shopCashSupport"=>'require',
            "phoneCashSupport"=>'require',
            "status"=>'require',
            "hot"=>'require',
            "ranking"=>'require'
        ];

        protected $message = [];

        protected $scene = [
             "index"=>['page'],
             "create"=>["category_id",'title','detail','img','banner','shopCashSupport','status','ranking','planCategory_id','mobile'],
             "update"=>['id',"category_id",'title','detail','img','banner','shopCashSupport','status','ranking','planCategory_id','mobile'],
             "delete"=>['id'],
             "updateStatus"=>['id','status'],
             "updateHot"=>['id','hot'],
             "itemDetail"=>['id'],
             "updateBanner"=>['id','banner']
        ];

}