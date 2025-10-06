<?php

namespace app\admin\service;

class ComponentBanner extends BaseService
{
    public function index($component_id){
        return $this->M->getList($component_id);
    }

    public function create($component_id,$data){
        $componentBanner = [
            'component_id' => $component_id,
            'img'=> $data['img'],
            'link'=>$data['link'],
            'status'=>$data['status'],
            'ranking'=>$data['ranking'],
        ];
        return $this->M->MPsave($componentBanner);
    }

    public function update($data){
        return request()->Model->save($data);
    }

    public function delete(){
        return $this->M->MPdelete();
    }

    public function updateStatus($status){
        return request()->Model->save(['status'=>$status]);
    }
}