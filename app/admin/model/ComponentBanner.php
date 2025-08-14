<?php

namespace app\admin\model;

class ComponentBanner extends Model
{
     public function getList($component_id){
          $list = $this->where('component_id',$component_id)->select();
          return [
              'list' => $list,
          ];
     }


}