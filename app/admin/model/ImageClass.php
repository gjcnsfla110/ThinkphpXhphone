<?php

namespace app\admin\model;

class ImageClass extends BaseM
{
    /**
     * 이미지 외래키 설정 부분
     * @return \think\model\relation\HasMany
     */
    public function images(){
         return $this->hasMany('Image');
    }

    /**
     * 이미지클래스 리스트 검색 모델
     * @param $data
     * @return array
     */
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

    public function MimgList($data){

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