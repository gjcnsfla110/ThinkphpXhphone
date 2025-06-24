<?php

namespace app\admin\validate;

class AgreementPlan extends BaseValidate
{
    protected $rule = [
         'id'=>"require|isModel",
         'isCheck' => "require",
         "categoryId"=>"require",
         "agreement_id"=>'require',
         "title"=>"require",
         "price"=>'require',
         "phone_sale"=>"require",
         "detail"=>'require',
         "ranking"=>"require",
    ];

    protected $message = [];

    protected $scene = [
         "index"=>['categoryId','isCheck','agreement_id'],
         "create"=>['agreement_id','title','price','phone_sale','detail','ranking'],
         "update"=>['id','agreement_id','title','price','phone_sale','detail','ranking'],
         "delete"=>['id'],
    ];
}