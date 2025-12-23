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
            //현재아이디에 속해있는 메인이미지 경로,삭제경로, 배너 경로, 배너삭제경로 컬럼담는 변수
            $imgData = request()->Model->used_img ? (array)request()->Model->used_img : [];
            $imgPath = request()->Model->used_img_name ? (array)request()->Model->used_img_name : [];
            $bannerData = request()->Model->used_banner ? (array)request()->Model->used_banner : [];
            $bannerPath = request()->Model->used_banner_name ? (array)request()->Model->used_banner_name : [];
            //디비에 업데이트하기위하여 이미지 ,배너 데이터를 담을 변수
            $used_img_path = [];
            $used_img_name = [];
            $used_banner_path = [];
            $used_banner_name = [];
            //원래업로드된 메인이미지 및 배너이미지 변수
            $originalImg=[];
            $originalBanner=[];
            //새로운 사진을 업로드한 메인이미지 와 배너이미지 변수
            $new_used_banner_path = [];
            $new_used_banner_name = [];
            //클라이언트에서 원래 정보를 보내여 값이 있으면 다시 배열로 전환하는 부분

            if (array_key_exists('originalImg', $param) && !empty($param['originalImg'])) {
                // 메인 이미지는 단일이므로 배열로 받지 않고 바로 디코딩
                $decodedImg = json_decode($param['originalImg'], true);
                if ($decodedImg && $decodedImg['isExisting'] === true) {
                    // 클라이언트가 이전에 존재하던 파일을 유지하기로 결정했을 때만
                    $originalImg[] = $decodedImg;
                }
            }
            if (array_key_exists('originalBanner', $param) && !empty($param['originalBanner'])) {
                $originalBanner = $param['originalBanner'];
                foreach ($originalBanner as &$item){
                    $item = json_decode($item, true);
                }
                // 해결책: 루프가 끝난 직후 참조를 해제합니다.
                unset($item);
            }


            if ($used_img !== null && $used_img->isValid()) {
                // A. 기존 파일이 있다면 삭제
                if (!empty($imgPath)) {
                    $this->uploadDelete($imgPath);
                }

                // B. 새로운 파일 업로드 및 데이터 저장
                $updateImgData = $this->uploadOne($used_img);
                $id = mt_rand(10, 10000);
                $name = $this->randName();

                // C. DB 업데이트 변수에 새로운 파일 정보 할당 (단일 값)
                $used_img_path[] = [
                    'id' => $id,
                    'name' => $name,
                    'url' => $updateImgData['imgUrl'],
                    'isExisting' => true
                ];
                $used_img_name[] = [
                    'id' => $id,
                    'name' => $name,
                    'url' => $updateImgData['imgPath'], // 삭제 경로
                    'isExisting' => true
                ];

                // 2-2. [기존 파일 유지] - 새 파일 업로드가 없고, 기존 파일 정보가 넘어왔을 때
            } else if($originalImg !== null && !empty($originalImg)){
                // 클라이언트에서 기존 이미지를 유지하라는 요청이 왔음
                // DB 업데이트 변수에 기존 파일 정보 할당 (단일 값)
                $used_img_path[] = [
                    'id' => $originalImg[0]['id'],
                    'name' => $originalImg[0]['name'],
                    'url' => $originalImg[0]['url'], // 삭제 경로
                    'isExisting' => true
                ];
                // $used_img_name은 원래 DB 경로를 그대로 유지
                $used_img_name = $imgPath;

                // 2-3. [기존 파일 삭제] - 새 파일 업로드도 없고, 유지 요청도 없을 때 (삭제 또는 빈 값)
            } else {
                // 클라이언트가 기존 파일을 삭제하기로 했거나 파일을 선택하지 않았음
                // A. 기존 파일이 DB에 있다면 삭제
                if (!empty($imgPath)) {
                    $this->uploadDelete($imgPath);
                }

                // B. DB 업데이트 변수를 빈 값으로 설정
                $used_img_path = [];
                $used_img_name = [];
            }


            //삭제할 배너이미지 경로를 추출하는 부분
            $deleteBannerPathName = $this->getDifferenceByTwoKeys($bannerPath,$originalBanner);
            //클라이언트에서 원래사진중 업로드할 부분데이터 를 추출하는부분 추출부분을 새로운이미지파일 업로드한 것이랑 합치기 위해서이다
            $updateBannerPathName = $this->getIntersectionByTwoKeys($bannerPath,$originalBanner);

            //삭제할 배너이미지
            if(!empty($deleteBannerPathName)){
                $this->uploadDelete($deleteBannerPathName);
            }

            //업로드된 새로운 배너이미지 저장 부분
            if(!empty($used_banner)){
                $bannerUploadResult =$this->commCompress($used_banner);
                foreach ($bannerUploadResult['imgUrl'] as $index=>$item){
                    $bannerId = mt_rand(10, 10000);
                    $bannerName = $this->randName();
                    $new_used_banner_path[] = [
                        'id'=>$bannerId,
                        'name'=>$bannerName,
                        'url'=>$item,
                        'isExisting'=>true
                    ];
                    $new_used_banner_name[]=[
                        'id'=>$bannerId,
                        'name'=>$bannerName,
                        'url'=>$bannerUploadResult['imgPath'][$index],
                        'isExisting'=>true
                    ];
                }
            }
            //데이터 합치는 부분
            $used_banner_path = array_merge($originalBanner,$new_used_banner_path);
            $used_banner_name = array_merge($updateBannerPathName,$new_used_banner_name);
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

    public function checkItemsList($param){
        $page = $param['page'] ? $param['page'] : 1;
        $limit = $param['limit'] ? $param['limit'] : 10;
        $where = [];
        if(array_key_exists('sideCategory_id', $param)){
            $where[] = ['sideCategory_id',"=",$param['sideCategory_id']];
        }
        return $this->M->checkItemsList($page,$limit,$where);
    }

}