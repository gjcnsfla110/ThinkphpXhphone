<?php

namespace app\admin\service;
class TitleMenu extends BaseService
{
    public function getAll($page,$limit){
        return $this->M->page($page,$limit)->order(['priority'=>'desc','id'=>'desc'])->select();
    }

    public function save($data){
        return $this->M->MPsave($data);
    }

    public function update($data){
        return request()->Model->save($data);
    }

    public function updateStatus($status){
        return $this->M->MPupdateStatus(['status'=>$status]);
    }

    public function delete(){
        return $this->M->MPdelete();
    }

}