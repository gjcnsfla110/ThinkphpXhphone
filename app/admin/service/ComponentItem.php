<?php

namespace app\admin\service;

class ComponentItem extends BaseService
{
    public function index($id){
        return $this->M->getList($id);
    }

    public function create($data){
        return $this->M->allCreatItem($data);
    }

    public function delete(){
        return $this->M->MPdelete();
    }

    public function updateRanking($ranking){
        return request()->Model->save(['ranking'=>$ranking]);
    }
    public function getGoodsList($param){
        $page = $param['page'] ? $param['page'] : 1;
        $limit = $param['limit'] ? $param['limit'] : 10;
        $isCheck = $param['isCheck'];
        $where = [];
        if(array_key_exists('category_id', $param)){
            $where[] = ['sideCategory_id',"=",$param['category_id']];
        }
        return $this->M->getGoodsList($page,$isCheck,$limit,$where);
    }

    public function updateChangeListType($listType){
        return request()->Model->save(['listType'=>$listType]);
    }

    public function getGoods($itemId){
        return $this->M->getGoods($itemId);
    }

    public function getAccessories($itemId){
        return $this->M->getAccessories($itemId);
    }

    public function getAgreement($itemId){
        return $this->M->getAgreement($itemId);
    }

    public function getUsim($itemId){
        return $this->M->getUsim($itemId);
    }
}