<?php

namespace app\admin\model;

use think\facade\Db;

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
        $total = $this->where('pid',0)->count();
        $parents = $this->page($data['page'],$limit)->order(
            [
                'order'=>'desc',
                'id'=>'desc'
            ]
        )->where('pid',0)->select();
        if ($parents->isEmpty()) {
            $list = []; // 부모가 없으면 빈 배열 반환
        }
        $parentIds = array_column($parents->toArray(),'id');
        $childs = $this->whereIn('pid',$parentIds)->order(
            [
                'order'=>'desc',
                "id"=>'desc'
            ]
        )->select();
        $childsIds = array_column($childs->toArray(),'id');
        $grandsons = $this->whereIn('pid',$childsIds)->order([
            'order'=>'desc',
            'id'=>'desc'
        ])->select();
        $list = array_merge_recursive($parents->toArray(),$childs->toArray(),$grandsons->toArray());
        $list =$this->list_to_tree2($list,'pid','child',0,function($v){
            return true;
        });
        return[
            'total'=>$total,
            'list'=>$list,
        ];
    }

    public function MimgList($data){
       $limit = getValueByKey("limit",$data,10);
       $model = request()->Model->images();
       $total = $model->count();
       $order = getValueByKey("order",$data,'desc');
       $list = $model->page($data['page'],$limit)->order('id',$order)->select();
       return [
           'list'=>$list,
           'total'=>$total,
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

    public function MselectAll(){
        $data = $this->order('id',"desc")->select();
        $list = $this->listChild($data->toArray(),'pid','child',0,function($v){
            return true;
        });
        return [
            'list'=>$list,
        ];
    }
    public function Mdelete($id){
        return $this->deleteCategoryWithChildren($this->getTable(),$id);
    }

    public function Mupdate($data){
        return $this->update($data);
    }

}