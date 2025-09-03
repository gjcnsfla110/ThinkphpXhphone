<?php

namespace app\admin\service;

class ComponentItem extends BaseService
{
    public function index($id){
        return $this->M->getList($id);
    }

    public function create($component_id,$data){
        $list = [];
        foreach ($data as $item){
            $list[] = [
                'component_id'=> $component_id,
                'goods_id'=>$item['id'],
                'type'=>$item['type'],
                'img'=>$item['img'],
                'label'=>$item['label'],
                'label_color'=>$item['label_color'],
                'storage'=>$item['storage'],
                'title'=>$item['title'],
                'color'=>$item['color'] ?? "",
                'price'=>$item['price'] ?? "",
                'price1'=>$item['price1'] ?? "",
                'price2'=>$item['price2'] ?? "",
            ];
        }
        return $this->M->allCreatItem($list);
    }

    public function delete(){
        return $this->M->MPdelete();
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

    public function getGoods($goods_id){
        return $this->M->getGoods($goods_id);
    }

    public function updateChangeListType($listType){
        return request()->Model->save(['listType'=>$listType]);
    }
}