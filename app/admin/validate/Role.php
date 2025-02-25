<?php

namespace app\admin\validate;

class Role extends BaseValidate
{
     protected $rule = [
         "id"=>"require|integer|>:0|isModel",
         "name"=>"require",
         "desc"=>"require",
         "status"=>"require|integer",
         "page"=>'require|integer',
         "ruleIds"=>"require|array"
     ];
     protected $message = [
          "id"=>"缺少账号数字",
          "name"=>"填写角色名称",
          "desc"=>"填写角色描述",
          "status"=>"选择状态"
     ];

     protected $scene = [
         "index"=>["page"],
         "addRole"=>["name","desc","status"],
         "updateRole"=>["id","name","desc","status"],
         "deleteRole"=>["id"],
         "updateStatus"=>['id','status'],
         "updateRules"=>["id","ruleIds"],
     ];
}