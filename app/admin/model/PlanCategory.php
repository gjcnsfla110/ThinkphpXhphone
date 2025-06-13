<?php

namespace app\admin\model;

class PlanCategory extends BaseM
{
        public function getPlanCategoryList($page, $limit){
            $list = $this->page($page, $limit)->select();
            $count = $this->count();
            return [
                "list"=>$list,
                "total"=>$count,
            ];
        }
}