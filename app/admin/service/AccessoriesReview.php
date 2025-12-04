<?php

namespace app\admin\service;

use think\facade\Db;

class AccessoriesReview extends BaseService
{
    public function index($param){
        $page = $param['page'] ? $param['page'] : 1;
        $limit = $param['limit'] ? $param['limit'] : 10;
        $where = [];
        if(array_key_exists('accessories_id', $param)){
            $where[] = ['accessories_id',"=",$param['accessories_id']];
        }
        if(array_key_exists('title', $param)){
            $where[] = ['title','like',"%".$param['title']."%"];
        }
        if(array_key_exists('type', $param)){
            $where[] = ['type',"=",$param['type']];
        }
        return $this->M->getList($page,$limit,$where);
    }

    public function add($accessories_id, $type, $title, $video, $date,$files){
        Db::startTrans();
        try {
            if($type == 1){
                $imgData = $this->commCompress($files);
                $img = json_encode($imgData['imgUrl']);
                $path = json_encode($imgData['imgPath']);
                $this->M->save([
                    'accessories_id'=>$accessories_id,
                    'type'=>$type,
                    'title'=>$title,
                    'video'=>$video,
                    'date'=>$date,
                    'img'=>$img,
                    'imgName'=>$path
                ]);
                Db::commit();
            }else{
                $this->M->save([
                    'accessories_id'=>$accessories_id,
                    'type'=>$type,
                    'title'=>$title,
                    'video'=>$video,
                    'img'=>json_encode([]),
                    'imgName'=>json_encode([]),
                    'date'=>$date,
                ]);
                Db::commit();
            }
            return ['msg'=>"성공하였습니다"];
        }catch (\Exception $e){
            Db::rollback();
            ApiException("上传失败:".$e->getMessage());
            return ['error'=>"업로드 실패"];
        }
    }

    public function delete(){
        Db::startTrans();
        $model = request()->Model;
        $path = json_decode($model->imgName);
        try {
            $this->commDeleteImgFile($path);
            $model->delete();
            Db::commit();
            return ['msg'=>"삭제성공"];
        }catch (\Exception $e){
            Db::rollback();
            ApiException("上传失败:".$e->getMessage());
        }
    }
}