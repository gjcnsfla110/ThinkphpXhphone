<?php

namespace app\admin\model;

class ImageClass extends BaseM
{
    public function images(){
         return $this->hasOne('Image');
    }

    public function Mlist($data){
        $limit = intval(getValueByKey('limit',$data,10));
        $total = $this->count();
        $list = $this->page($data['page'],$limit)->order(
            [
                'order'=>'desc',
                'id'=>'desc'
            ]
        )->select();
        $list =$this->list_to_tree2($list->toArray(),'pid','child',0,function($v){
            return true;
        });
        return[
            'total'=>$total,
            'list'=>$list,
        ];
    }
    /**
     * 이미지 클래스 추가
     * @param $data
     * @return void
     */
    public function Mcreate($data){
        $this->create($data);
    }
}