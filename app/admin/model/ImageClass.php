<?php

namespace app\admin\model;
use app\admin\model\Image;
use think\facade\Filesystem;
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
       $list = $model->page($data['page'],$limit)->order('id','desc')->select();
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
        $ids = $this->deleteCategoryWithChildren($this->getTable(),$id);
        $imgs = Image::whereIn('image_class_id',$ids)->select();
        $disk = Filesystem::disk('public');
        try {
            foreach ($imgs as $img){
                if ($disk->has($img['name'])) {
                    $disk->delete($img['name']);
                }
            }
        } catch (\Exception $e) {
            // 예외를 로깅하거나 사용자 정의 예외로 던지기
            throw new \Exception("上传图片失败，请联系客服: " . $e->getMessage());
        }
        $data = $this->whereIn('id',$ids)->delete();
        return $data;
    }

    public function Mupdate($data){
        return $this->update($data);
    }
}