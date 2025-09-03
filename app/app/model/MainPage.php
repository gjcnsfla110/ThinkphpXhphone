<?php

namespace app\app\model;
use app\app\model\MainPage as MainPageModel;
use app\admin\model\SubMenu;
use app\admin\model\Component;
use app\admin\model\ComponentItem;
use app\admin\model\ComponentBanner;

class MainPage extends BaseM
{
        public function getMain(){
            $pages = MainPageModel::where("status",1)->select();
            $subMenus = SubMenu::where("status",1)->select();
            $components = Component::where("status",1)->order(['ranking'=>'desc'])->select();
            $componentItems = ComponentItem::select();
            $componentBanners = ComponentBanner::where("status",1)->select();
            return [
                'pages'=>$pages,
                'subMenus'=>$subMenus,
                'components'=>$components,
                'componentItems'=>$componentItems,
                'componentBanners'=>$componentBanners,
            ];
        }
}