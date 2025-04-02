<?php

namespace app\admin\service;

class Service extends BaseService
{
    public function index($page,$limit){
        return $this->M->getAll($page,$limit);
    }

    public function add($data){
        $title = isset($data['title']) ? (string)$data['title'] : '';
        $description = isset($data['description']) ? (string)$data['description'] : '';

        // JSON 인코딩
        $data['description'] = json_encode([
            'title' => $title,
            'description' => $description
        ]);
        return $this->M->MPsave($data);
    }

    public function update($data){
        $title = isset($data['title']) ? (string)$data['title'] : '';
        $description = isset($data['description']) ? (string)$data['description'] : '';

        // JSON 인코딩
        $data['description'] = json_encode([
            'title' => $title,
            'description' => $description
        ]);
        return request()->Model->save($data);
    }

    public function delete(){
        return $this->M->MPdelete();
    }
}