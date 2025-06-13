<?php

namespace app\admin\model;
use app\admin\model\MainPage;

class PageBanner extends BaseM
{
    public function getBanners($page,$limit,$where){
        $pages = MainPage::select()->toArray();
        $list = $this->page($page,$limit)->where($where)->select();
        $count = $this->count();
        return [
            "pageList"=> $pages,
            "total"=> $count,
            "bannerList"=>$list
        ];
    }
}