<?php

namespace app\admin\service;

class SubMenuCategory extends BaseService
{
    public function index($param){
        $page = $param['page'] ? $param['page'] : 1;
        $limit = $param['limit'] ? $param['limit'] : 10;
        $where = [];
        if(array_key_exists('type', $param)){
            $where[] = ['type',"=",$param['type']];
        }
        return $this->M->getList($page,$limit,$where);
    }

    public function create($pram){
        return $this->M->create($pram);
    }

    public function update($param){
        return request()->Model->save($param);
    }

    public function delete(){
        return $this->M->MPdelete();
    }

    public function addItems($items){
         $subPageCategoryModel = request()->Model;
         $oldItems = (array)$subPageCategoryModel->items;
         if(empty($oldItems)){
             $subPageCategoryModel->items = $items;
         }else{
             foreach ($items as $value) {
                 array_unshift($oldItems, $value);   // 그냥 끝에 추가 (키 무시하고 값만)
             }
             $subPageCategoryModel->items = $oldItems;
         }
         $subPageCategoryModel->save();
    }

    public function deleteItem($itemId,$itemUid){
        return $this->removeItemFromJson(request()->Model,$itemId,$itemUid);
    }

    public function updateStatus($status){
        return request()->Model->save(['status'=>$status]);
    }

    public function getOneItem(){
        return request()->Model->items;
    }

    /**
     * JSON 배열에서 id와 uid로 조회 후 삭제하는 함수
     *
     * @param int    $userId   // users 테이블의 PK (예: 1)
     * @param int    $targetId // JSON 안의 id 값
     * @param string $targetUid // JSON 안의 uid 값
     * @return array|null       // 삭제된 항목 반환, 없으면 null
     */
    public function removeItemFromJson($DataDb, $targetId, $targetUid)
    {
        // 해당 사용자 조회
        if (!$DataDb) {
            return null;
        }

        $infoArray = $DataDb->items; // JSON 자동 파싱되어 배열로 반환

        // id와 uid가 모두 일치하는 항목 찾기
        $foundIndex = -1;

        foreach ($infoArray as $index => $item) {
            if (isset($item['id']) && isset($item['uid']) &&
                $item['id'] == $targetId && $item['uid'] === $targetUid) {
                $foundIndex = $index;
                break;
            }
        }

        // 찾지 못하면 null 반환
        if ($foundIndex === -1) {
            return '삭제할 아이템을 못찾았어요';
        }

        // 배열에서 해당 항목 삭제
        array_splice($infoArray, $foundIndex, 1);

        // DB에 업데이트 (info 필드 자동 JSON 인코딩)
        $DataDb->items = $infoArray;
        $DataDb->save();

        // 삭제된 항목 반환
        return "삭제성공하였습니다";
    }
}