<?php

namespace app\app\model;
use app\app\model\MainPage as MainPageModel;
use app\admin\model\SubMenu;
use app\admin\model\Component;
use app\admin\model\ComponentItem;
use app\admin\model\ComponentBanner;
use app\admin\model\GoodsSpec;
use app\admin\model\goodsCategory;
use app\admin\model\GoodsSubmenu;
use app\admin\model\AccessoriesCategory;
use app\admin\model\AccessoriesSubCategory;

class MainPage extends BaseM
{
        public function getMain(){
            $pages = MainPageModel::where("status",1)->select();
            $subMenus = SubMenu::where("status",1)->order(['ranking'=>'desc'])->select();
            $components = Component::where("status",1)->order(['ranking'=>'desc'])->select();
            $componentItems = ComponentItem::select();
            $componentBanners = ComponentBanner::where("status",1)->select();
            $goodsSpecs = GoodsSpec::select();
            $categoryMenu = goodsCategory::where("status",1)->order(['ranking'=>'desc'])->select();
            $categorySubmenu = GoodsSubmenu::where("status",1)->order(['ranking'=>'desc'])->select();
            $accessoriesCategoryData = AccessoriesCategory::where("status",1)->order(['ranking'=>'desc'])->select();
            $accessoriesSubCategoryData = AccessoriesSubCategory::where("status",1)->order(['ranking'=>'desc'])->select();
            return [
                'pages'=>$pages,
                'subMenus'=>$subMenus,
                'components'=>$components,
                'componentItems'=>$componentItems,
                'componentBanners'=>$componentBanners,
                'goodsSpecs'=>$goodsSpecs,
                'categoryMenu'=>$categoryMenu,
                'categorySubmenu'=>$categorySubmenu,
                'accessoriesCategory'=>$accessoriesCategoryData,
                'accessoriesSubCategory'=>$accessoriesSubCategoryData,
            ];
        }
}