<?php

namespace app\admin\model;
use app\common\BaseModel;

class BaseM extends BaseModel
{
    /**
     * 재귀함수를 사용하여 ID값을 갖고오는 방법 /최상위 ID 검색후  나를 기준으로 카테고리등 여러개 자식연결된 아이디를 갖고오는 함수
     * hasMany 사용시 사용할것  1대 다수연결
     * @param $id
     * @param $functionName
     * @param $childids
     * @return array|mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    protected function getAllChildIds($id,$functionName,&$childids = []){
        //아이디로 현재모델을 채택
        $model = $this->find($id);
        //모델이 있으면 재귀함수로 ID값을 갖고오기
        if($model){
            $model->$functionName->each(function($item) use (&$childids,$functionName){
                $childids[] = $item->id;
                $item->getAllChildIds($item->id,$functionName,$childids);
            });
        }
        return $childids;
    }
}