<?php

namespace app\admin\service;

class Goods extends BaseService
{
    public function index($param){
        $page = $param['page'] ? $param['page'] : 1;
        $limit = $param['limit'] ? $param['limit'] : 10;
        $isCheck = $param['isCheck'];
        $where = [];
        if(array_key_exists('sideCategory_id', $param)){
            $where[] = ['sideCategory_id',"=",$param['sideCategory_id']];
        }
        if(array_key_exists('item_number', $param)){
            $where[] = ['item_number',"=",$param['item_number']];
        }
        if(array_key_exists('model', $param)){
            $where[] = ['model','=',$param['model']];
        }
        if(array_key_exists('type', $param)){
            $where[] = ['type','=',$param['type']];
        }
        if(array_key_exists('title1', $param)){
            $where[] = ['title1','like',"%".$param['title1']."%"];
        }
        return $this->M->getList($page,$isCheck,$limit,$where);
    }
    public function add($param,$dataType,$used_img,$used_banner){
        $data=[];
        if($dataType==='old'){
            $used_img_path = [];
            $used_img_name = [];
            $used_banner_path = [];
            $used_banner_name = [];
            $imgPath = $this->uploadOne($used_img);
            $bannerPath =$this->commCompress($used_banner);
            $id = mt_rand(10, 10000);
            $name = $this->randName();
            $used_img_path[] = [
                'id'=>$id,
                'name'=>$name,
                'url'=>$imgPath['imgUrl'],
                'isExisting'=>true
            ];
            $used_img_name[] =[
                'id'=>$id,
                'name'=>$name,
                'url'=>$imgPath['imgPath'],
                'isExisting'=>true
            ];
            foreach ($bannerPath['imgUrl'] as $index=>$item){
                 $bannerId = mt_rand(10, 10000);
                 $bannerName = $this->randName();
                 $used_banner_path[] = [
                     'id'=>$bannerId,
                     'name'=>$bannerName,
                     'url'=>$item,
                     'isExisting'=>true
                 ];
                 $used_banner_name[]=[
                     'id'=>$bannerId,
                     'name'=>$bannerName,
                     'url'=>$bannerPath['imgPath'][$index],
                     'isExisting'=>true
                 ];
            }

            $data = [
                'category_id'=>$param['category_id'],
                'sideCategory_id'=>$param['sideCategory_id'],
                'item_number'=>$param['item_number'],
                'label'=>$param['label'],
                'label_color'=>$param['label_color'],
                'model'=>$param['model'],
                'type'=>$param['type'],
                'title'=>$param['title'],
                'title1'=>$param['title1'],
                'price'=>$param['price'],
                'price1'=>$param['price1'],
                'price2'=>$param['price2'],
                'color'=>$param['color'],
                'storage'=>$param['storage'],
                'status'=>$param['status'],
                'order'=>$param['order'],
                'used_img'=>$used_img_path,
                'used_img_name'=>$used_img_name,
                'used_banner'=>$used_banner_path,
                'used_banner_name'=>$used_banner_name,
                'phone_detail'=>$param['phone_detail'],
                'video_title'=>$param['video_title'],
                'video_link'=>$param['video_link'],
                'isShop'=>$param['isShop'],
            ];
        }else if ($dataType === "new"){
            $data = $param;
        }
        return $this->M->save($data);
    }

    public function update($param,$dataType,$used_img,$used_banner){
        $data = [];
        if($dataType==='old'){
            $imgData = (array)request()->Model->used_img;
            $imgPath = (array)request()->Model->used_img_name;
            $bannerData = (array)request()->Model->used_banner;
            $bannerPath = (array)request()->Model->used_banner_name;
            $used_img_path = [];
            $used_img_name = [];
            $used_banner_path = [];
            $used_banner_name = [];
            $originalImg=[];
            $originalBanner=[];
            if (array_key_exists('originalImg', $param) && !empty($param['originalImg'])) {
                $originalImg[] = json_decode($param['originalImg'],true);
            }
            if (array_key_exists('originalBanner', $param) && !empty($param['originalBanner'])) {
                $originalBanner = $param['originalBanner'];
                foreach ($originalBanner as &$item){
                    $item = json_decode($item, true);
                }
            }
            if(count($originalImg)>0 && !empty($originalImg)){
                $used_img_path = [
                    'id'=>$originalImg[0]['id'],
                    'name'=>$originalImg[0]['name'],
                    'url'=>$originalImg[0]['url'],
                    'isExisting'=>true
                ];
                $used_img_name = $imgPath;
            }else if($used_img !== null){
                $this->uploadDelete($imgPath);
                $imgPath = $this->uploadOne($used_img);
                $id = mt_rand(10, 10000);
                $name = $this->randName();
                $used_img_path[] = [
                    'id'=>$id,
                    'name'=>$name,
                    'url'=>$imgPath['imgUrl'],
                    'isExisting'=>true
                ];
                $used_img_name[] =[
                    'id'=>$id,
                    'name'=>$name,
                    'url'=>$imgPath['imgPath'],
                    'isExisting'=>true
                ];
            }

            $deleteBannerPathName = $this->getDifferenceByTwoKeys($bannerPath,$originalBanner);
            $updateBannerPathName = $this->getIntersectionByTwoKeys($bannerPath,$originalBanner);
            halt($bannerPath,$originalBanner,$deleteBannerPathName,$updateBannerPathName);
            if(!empty($deleteBannerPathName)){
                $this->uploadDelete($deleteBannerPathName);
            }

            $bannerPath =$this->commCompress($used_banner);

            foreach ($bannerPath['imgUrl'] as $index=>$item){
                $bannerId = mt_rand(10, 10000);
                $bannerName = $this->randName();
                $used_banner_path[] = [
                    'id'=>$bannerId,
                    'name'=>$bannerName,
                    'url'=>$item,
                    'isExisting'=>true
                ];
                $used_banner_name[]=[
                    'id'=>$bannerId,
                    'name'=>$bannerName,
                    'url'=>$bannerPath['imgPath'][$index],
                    'isExisting'=>true
                ];
            }

            $data = [
                'category_id'=>$param['category_id'],
                'sideCategory_id'=>$param['sideCategory_id'],
                'item_number'=>$param['item_number'],
                'label'=>$param['label'],
                'label_color'=>$param['label_color'],
                'model'=>$param['model'],
                'type'=>$param['type'],
                'title'=>$param['title'],
                'title1'=>$param['title1'],
                'price'=>$param['price'],
                'price1'=>$param['price1'],
                'price2'=>$param['price2'],
                'color'=>$param['color'],
                'storage'=>$param['storage'],
                'status'=>$param['status'],
                'order'=>$param['order'],
                'used_img'=>$used_img_path,
                'used_img_name'=>$used_img_name,
                'used_banner'=>$used_banner_path,
                'used_banner_name'=>$used_banner_name,
                'phone_detail'=>$param['phone_detail'],
                'video_title'=>$param['video_title'],
                'video_link'=>$param['video_link'],
                'isShop'=>$param['isShop'],
            ];
        }else if($dataType === "new"){
            $data = $param;
        }
        return request()->Model->save($data);
    }
    public function updateBanner($banner){
        return request()->Model->save(['banner'=>json_encode($banner)]);
    }

    public function updateContent($content)
    {
        return request()->Model->save(['content'=>$content]);
    }
    public function updateStatus($status){
        return request()->Model->save(['status'=>$status]);
    }

    public function checkUpdateStatus($status, $ids){
        return $this->M->checkUpdateStatus($status, $ids);
    }

    public function delete(){
        return $this->M->MPdelete();
    }

    public function deleteAll($ids){
        return $this->M->deleteAll($ids);
    }

}