<?php
use think\facade\Route;
Route::setOption('complete_match', true);

Route::group(function(){
    Route::post('login','Manager/login')->name('login');
    Route::get('join','Manager/addM')->name('join');
    Route::get('test','Manager/test')->name('test');
})->allowCrossDomain();

//토큰이 있는지 확인 하는부분
Route::group(function(){
    Route::post('getInfo','Manager/getInfo')->name('getInfo');
    Route::post('logout','Manager/logout')->name('logout');
})->allowCrossDomain([
    "Access-Control-Allow-Headers"=>"token"
])->middleware(\app\admin\middleware\HasManagerToken::class);

//토큰과 모델이 있는지 체크하는부분
Route::group(function(){

    //매니저 부분
    Route::get("manager/:page/list/:limit","Manager/getManagers")->name("getManagers");
    Route::post("manager/add","Manager/addManager")->name("addManager");
    Route::post("manager/updatePass","Manager/updatePass")->name("updatePass");
    Route::post("manager/delete","Manager/deleteManager")->name("deleteManager");
    Route::post("manager/:id/update","Manager/updateManager")->name("updateManager");
    Route::post("manager/:id/updateStatus","Manager/updateStatus")->name("updateStatus");
    Route::post("manager/:id/reset","Manager/superPassReset")->name("passReset");


    //이미지 클래스(image_class) 부분
    Route::post("image_class","ImageClass/save")->name('createImageClass');
    Route::get('image_class/:page','ImageClass/index')->name('getImageClassList');
    Route::get('image_class/:id/images/:page$','ImageClass/imagesList')->name('getImagesList');
    Route::post('image_class/all','ImageClass/all')->name('getAllImageClass');
    Route::post('image_class/update','ImageClass/update')->name('updateImageClass');
    Route::post('image_class/delete','ImageClass/delete')->name('deleteImageClass');

    //이미지 (image)부분
    Route::post('image/upload','Image/save')->name('uploadImage');
    Route::post('image/delete','Image/delete')->name('deleteImage');
    Route::post('image/:id/update','Image/update')->name('updateImage');

    //윗해더부분 메뉴
    Route::get('title_menu/:page','TitleMenu/index')->name('getTitleMenuList');
    Route::post('title_menu','TitleMenu/save')->name('saveTitleMenu');
    Route::post('title_menu/:id/updateStatus','TitleMenu/updateStatus')->name('updateTitleMenuStatus');
    Route::post('title_menu/:id/update','TitleMenu/update')->name('updateTitleMenu');
    Route::post('title_menu/:id/delete','TitleMenu/delete')->name('deleteTitleMenu');

    //메뉴부분
    Route::get('rule/listAll','Rule/allList')->name('getRuleListAll');
    Route::get("rule/:page","Rule/index")->name('getRuleList');
    Route::post('rule','Rule/addRule')->name('saveRule');
    Route::post('rule/:id/delete','Rule/deleteRule')->name('deleteRule');
    Route::post('rule/:id/update','Rule/updateRule')->name('updateRule');
    Route::post('rule/:id/updateStatus','Rule/updateStatus')->name('updateRuleStatus');

    //관리자회원그룹상태
    Route::get('role/:page','Role/index')->name('getRoleList');
    Route::post('role','Role/addRole')->name('addRole');
    Route::post('role/:id/delete','Role/deleteRole')->name('deleteRole');
    Route::post('role/:id/update','Role/updateRole')->name('updateRole');
    Route::post('role/:id/updateStatus','Role/updateStatus')->name('updateRoleStatus');
    Route::post('role/:id/updateRules','Role/updateRules')->name('updateRules');

    //상품카테고리부분
    Route::get('goods_category/:page/list','GoodsCategory/list')->name('getGoodsCategoryList');
    Route::post('goods_category','GoodsCategory/add')->name('addGoodsCategory');
    Route::post('goods_category/:id/update','GoodsCategory/update')->name('updateGoodsCategory');
    Route::post('goods_category/:id/updateStatus','GoodsCategory/updateStatus')->name('updateGoodsCategoryStatus');
    Route::post('goods_category/:id/delete','GoodsCategory/delete')->name('deleteGoodsCategory');

    //상품서브카테고리 부분
    Route::get('goodsSubMenu/:page/list','GoodsSubMenu/index')->name('getGoodsSubMenuList');
    Route::post('goodsSubMenu/create','GoodsSubMenu/create')->name('addGoodsSubMenu');
    Route::post('goodsSubMenu/:id/update','GoodsSubMenu/update')->name('updateGoodsSubMenu');
    Route::post('goodsSubMenu/:id/delete','GoodsSubMenu/delete')->name('deleteGoodsSubMenu');
    Route::post('goodsSubMenu/:id/updateStatus','GoodsSubMenu/updateStatus')->name('updateStatus');

    //상품
    Route::get('goods/:page/list','Goods/index')->name('getGoodsList');
    Route::get('goods/checkList/:page/list','Goods/checkItemsList')->name('getCheckItemsList');
    Route::post('goods/create','Goods/add')->name('addGoods');
    Route::post('goods/update','Goods/update')->name('updateGoods');
    Route::post('goods/:id/delete','Goods/delete')->name('deleteGoods');
    Route::post('goods/:id/updateStatus','Goods/updateStatus')->name('updateGoodsStatus');
    Route::post('goods/updateStatusAll','Goods/checkUpdateStatus')->name('updateGoodsStatusAll');
    Route::post('goods/:id/delete','Goods/delete')->name('deleteGoods');
    Route::post('goods/deleteAll','Goods/deleteAll')->name('deleteAllGoods');
    Route::post('goods/:id/banner','Goods/updateBanner')->name('updateGoodsStatus');
    Route::post('goods/:id/updateContent','Goods/updateContent')->name('updateContent');

    //상품리뷰
    Route::get('goods/review/:page/list','GoodsReview/index')->name('goodsReviewList');
    Route::post('goods/review/create','GoodsReview/add')->name('addGoodsReview');
    Route::post('goods/review/:id/delete','GoodsReview/delete')->name('deleteGoodsReview');

    //상품스펙부분
    Route::get('spec/:page/list','GoodsSpec/index')->name('getSpecList');
    Route::post('spec','GoodsSpec/add')->name('addSpec');
    Route::post('spec/:id/update','GoodsSpec/update')->name('updateSpec');
    Route::post('spec/:id/updateStatus','GoodsSpec/updateStatus')->name('updateSpecStatus');
    Route::post('spec/:id/delete','GoodsSpec/delete')->name('deleteSpec');

    //상품모델
    Route::get('model/:page/list','Model/index')->name('getModelList');
    Route::post('model','Model/add')->name('addModel');
    Route::post('model/:id/update','Model/update')->name('updateModel');
    Route::post('model/:id/updateStatus','Model/updateStatus')->name('updateModelStatus');
    Route::post('model/:id/delete','Model/delete')->name('deleteModel');

    //상품브랜드
    Route::get('brand/:page/list','Brand/index')->name('getBrandList');
    Route::post('brand','Brand/add')->name('addBrand');
    Route::post('brand/:id/update','Brand/update')->name('updateBrand');
    Route::post('brand/:id/delete','Brand/delete')->name('deleteBrand');

    //상품색상
    Route::get('color/:page/list','GoodsColor/index')->name('getColorList');
    Route::post('color','GoodsColor/add')->name('addColor');
    Route::post('color/:id/update','GoodsColor/update')->name('updateColor');
    Route::post('color/:id/delete','GoodsColor/delete')->name('deleteColor');

    //상품라벨
    Route::get('label/:page/list','Label/index')->name('getLabelList');
    Route::post('label','Label/add')->name('addLabel');
    Route::post('label/:id/update','Label/update')->name('updateLabel');
    Route::post('label/:id/delete','Label/delete')->name('deleteLabel');

    //배송방법
    Route::get('deliveries/:page/list','Delivery/index')->name('getDeliveryList');
    Route::post('deliveries','Delivery/add')->name('addDelivery');
    Route::post('deliveries/:id/update','Delivery/update')->name('updateDelivery');
    Route::post('deliveries/:id/delete','Delivery/delete')->name('deleteDelivery');

    //배송회사
    Route::get('deliveryCompany/:page/list','DeliveryCompany/index')->name('getDeliveryCompanyList');
    Route::post('deliveryCompany','DeliveryCompany/add')->name('addDeliveryCompany');
    Route::post('deliveryCompany/:id/update','DeliveryCompany/update')->name('updateDeliveryCompany');
    Route::post('deliveryCompany/:id/delete','DeliveryCompany/delete')->name('deleteDeliveryCompany');

    //상붐서비스
    Route::get('service/:page/list','Service/index')->name('getServiceList');
    Route::post('service','Service/add')->name('addService');
    Route::post('service/:id/update','Service/update')->name('updateService');
    Route::post('service/:id/delete','Service/delete')->name('deleteService');

    //유심카테고리
    Route::get('usimCategory/:page/list','UsimCategory/index')->name('getUsimCategoryList');
    Route::post('usimCategory/create','UsimCategory/add')->name('addUsimCategory');
    Route::post('usimCategory/:id/update','UsimCategory/update')->name('updateUsimCategory');
    Route::post('usimCategory/:id/delete','UsimCategory/delete')->name('deleteUsimCategory');
    Route::post('usimCategory/:id/updateStatus','UsimCategory/updateStatus')->name('updateUsimCategoryStatus');
    Route::post('usimCategory/:id/updateHot','UsimCategory/updateHot')->name('updateUsimCategoryHot');

    //유심
    Route::get('usim/:page/list','Usim/index')->name('getUsimList');
    Route::get('usim/checkList/:page/list','Usim/checkItemsList')->name('getCheckItemsList');
    Route::post('usim/create','Usim/create')->name('createUsim');
    Route::post('usim/:id/update','Usim/update')->name('updateUsim');
    Route::post('usim/:id/delete','Usim/delete')->name('deleteUsim');
    Route::post('usim/:id/updateStatus','Usim/updateStatus')->name('updateUsimStatus');
    Route::post('usim/:id/updateHot','Usim/delete')->name('deleteUsim');
    Route::post('usim/item/detail','Usim/item')->name('itemDetail');

    //계약폰 카테고리 부분
    Route::get('phone/category/:page/list','AgreementCategory/index')->name('getPhoneCategoryList');
    Route::post('phone/category/create','AgreementCategory/create')->name('addPhoneCategory');
    Route::post('phone/category/:id/update','AgreementCategory/update')->name('updatePhoneCategory');
    Route::post('phone/category/:id/delete','AgreementCategory/delete')->name('deletePhoneCategory');
    Route::post('phone/category/:id/updateStatus','AgreementCategory/updateStatus')->name('updatePhoneCategory');
    Route::post('phone/category/:id/changeHot','AgreementCategory/updateHot')->name('updatePhoneCategoryHot');

    //계약폰 서브카테고리 부분
    Route::get('phone/sideCategory/:page/list','AgreementSideCategory/index')->name('getPhoneSideCategoryList');
    Route::post('phone/sideCategory/create','AgreementSideCategory/create')->name('addPhoneSideCategory');
    Route::post('phone/sideCategory/:id/update','AgreementSideCategory/update')->name('updatePhoneSideCategory');
    Route::post('phone/sideCategory/:id/delete','AgreementSideCategory/delete')->name('deletePhoneSideCategory');
    Route::post('phone/sideCategory/:id/updateStatus','AgreementSideCategory/updateStatus')->name('updatePhoneSideCategoryStatus');

    //계약상품 부분
    Route::get('phoneList/:page/list','Agreement/index')->name('getPhoneList');
    Route::get('phoneList/checkList/:page/list','Agreement/checkItemsList')->name('getCheckItemsList');
    Route::post('phoneList/create','Agreement/create')->name('addPhoneList');
    Route::post('phoneList/:id/update','Agreement/update')->name('updatePhoneList');
    Route::post('phoneList/:id/delete','Agreement/delete')->name('deletePhoneList');
    Route::post('phoneList/:id/updateStatus','Agreement/updateStatus')->name('updateStatus');
    Route::post('phoneList/:id/updateHot','Agreement/updateHot')->name('updateHot');
    Route::post('phoneList/item','Agreement/itemDetail')->name('itemDetail');
    Route::post('phoneList/:id/updateBanner','Agreement/updateBanner')->name('updateBanner');


    //게약상품 리뷰
    Route::get('agreement/review/:page/list','AgreementReview/index')->name('goodsReviewList');
    Route::post('agreement/review/create','AgreementReview/add')->name('addGoodsReview');
    Route::post('agreement/review/:id/delete','AgreementReview/delete')->name('deleteGoodsReview');


    //계약폰 요금제 부분
    Route::get('/phone/phonePlan/:categoryId/list','AgreementPlan/index')->name('getPhonePlanList');
    Route::post('phone/phonePlan/create','AgreementPlan/create')->name('addPhonePlan');
    Route::post('phone/phonePlan/:id/update','AgreementPlan/update')->name('updatePhonePlan');
    Route::post('phone/phonePlan/:id/delete','AgreementPlan/delete')->name('deletePhonePlan');

    //요금제 카테고리
    Route::get('phone/planCategory/:page/list','PlanCategory/index')->name('getPlanCategoryList');
    Route::post('phone/planCategory/create','PlanCategory/create')->name('addPlanCategory');
    Route::post('phone/planCategory/:id/update','PlanCategory/update')->name('updatePlanCategory');
    Route::post('phone/planCategory/:id/delete','PlanCategory/delete')->name('deletePlanCategory');
    Route::post('phone/planCategory/:id/updateStatus','PlanCategory/updateStatus')->name('updatePlanCategoryStatus');

    //요금제 부분
    Route::get('phone/plan/:page/list','Plan/index')->name('getPlanList');
    Route::post('phone/plan/create','Plan/create')->name('addPlan');
    Route::post('phone/plan/:id/update','Plan/update')->name('updatePlan');
    Route::post('phone/plan/:id/delete','Plan/delete')->name('deletePlan');
    Route::post('phone/plan/:id/updateStatus','Plan/updateStatus')->name('updatePlanStatus');

    //카드부분부분
    Route::get('phone/creditCard/:page/list','CreditCard/index')->name('getCreditCardList');
    Route::post('phone/creditCard/create','CreditCard/create')->name('addCreditCard');
    Route::post('phone/creditCard/:id/update','CreditCard/update')->name('updateCreditCard');
    Route::post('phone/creditCard/:id/delete','CreditCard/delete')->name('deleteCreditCard');
    Route::post('phone/creditCard/:id/updateStatus','CreditCard/updateStatus')->name('updateCreditCardStatus');

    //메인페이지부분
    Route::get('main/:page/list','MainPage/index')->name('getMainList');
    Route::post('main/create','MainPage/create')->name('addMain');
    Route::post('main/:id/update','MainPage/update')->name('updateMain');
    Route::post('main/:id/delete','MainPage/delete')->name('deleteMain');
    Route::post('main/:id/updateStatus','MainPage/updateStatus')->name('updateMainStatus');

    //서브메뉴
    Route::get('subPage/:page/list','SubMenu/index')->name('getSubPageList');
    Route::post('subPage/create','SubMenu/create')->name('addSubPage');
    Route::post('subPage/:id/update','SubMenu/update')->name('updateSubPage');
    Route::post('subPage/:id/delete','SubMenu/delete')->name('deleteSubPage');
    Route::post('subPage/:id/updateStatus','SubMenu/updateStatus')->name('updateSubPageStatus');


    //서브메뉴 카테고리
    Route::get('subPageCategory/:page/list','SubMenuCategory/index')->name('getSubPageCategoryList');
    Route::post('subPageCategory/create','SubMenuCategory/create')->name('addSubMenuCategory');
    Route::post('subPageCategory/:id/update','SubMenuCategory/update')->name('updateSubMenuCategory');
    Route::post('subPageCategory/:id/delete','SubMenuCategory/delete')->name('deleteSubMenuCategory');
    Route::post('subPageCategory/:id/updateStatus','SubMenuCategory/updateStatus')->name('updateSubMenuCategoryStatus');
    Route::post('subPageCategory/:id/addItems','SubMenuCategory/addItems')->name('addSubMenuCategoryItems');
    Route::post('subPageCategory/:id/oneItem','SubMenuCategory/getOneItem')->name('getOneItem');
    Route::post('subPageCategory/:id/deleteItem','SubMenuCategory/deleteItem')->name('addSubMenuCategoryDeleteItem');

    //배너추가
    Route::get('banner/:page/list','PageBanner/index')->name('getBannerList');
    Route::post('banner/create','PageBanner/create')->name('addBanner');
    Route::post('banner/:id/update','PageBanner/update')->name('updateBanner');
    Route::post('banner/:id/delete','PageBanner/delete')->name('deleteBanner');
    Route::post('banner/:id/updateStatus','PageBanner/updateStatus')->name('updateBannerStatus');

    //컴포넌트 이름추가
    Route::get('componentName/:page/list','ComponentName/index')->name('getMainComponentNameList');
    Route::post('componentName/create','ComponentName/create')->name('addMainComponentName');
    Route::post('componentName/:id/update','ComponentName/update')->name('updateMainComponentName');
    Route::post('componentName/:id/delete','ComponentName/delete')->name('deleteMainComponentName');

    //컴포넌터
    Route::get('component/:page/list','Component/index')->name('getComponentList');
    Route::post('component/create','Component/create')->name('addComponent');
    Route::post('component/:id/update','Component/update')->name('updateComponent');
    Route::post('component/:id/delete','Component/delete')->name('deleteComponent');
    Route::post('component/:id/updateStatus','Component/updateStatus')->name('updateComponentStatus');

    //컴포넌트 아이템
    Route::get('componentItems/:component_id/list','ComponentItem/index')->name('getComponentItemList');
    Route::post('componentItems/:component_id/create','ComponentItem/create')->name('addComponentItem');
    Route::post('componentItems/:id/delete','ComponentItem/delete')->name('deleteComponentItem');
    Route::post('componentItems/:id/updateRanking','ComponentItem/updateRanking')->name('updateRankingComponentItem');
    Route::post('componentItems/:page/getGoodsList','ComponentItem/getGoodsList')->name('getGoodsList');
    Route::post('componentItems/:id/updateChangeListType','ComponentItem/updateChangeListType')->name('updateChangeListType');
    Route::post('componentItems/:item_id/getGoods','ComponentItem/getGoods')->name('getGoods');
    Route::post('componentItems/:item_id/getAccessories','ComponentItem/getAccessories')->name('getAccessories');
    Route::post('componentItems/:item_id/getAgreement','ComponentItem/getAgreement')->name('getAgreement');
    Route::post('componentItems/:item_id/getUsim','ComponentItem/getUsim')->name('getUsim');

    //컴포넌트 배너
    Route::get('componentBanner/:component_id/list','ComponentBanner/index')->name('getComponentBannerList');
    Route::post('componentBanner/create','ComponentBanner/create')->name('addComponentBanner');
    Route::post('componentBanner/:id/update','ComponentBanner/update')->name('updateComponentBanner');
    Route::post('componentBanner/:id/delete','ComponentBanner/delete')->name('deleteComponentBanner');
    Route::post('componentBanner/:id/updateStatus','ComponentBanner/updateStatus')->name('updateComponentBannerStatus');
    Route::post('componentBanner/get/goodsItem','ComponentBanner/getGoodsItem')->name('getGoodsItem');
    Route::post('componentBanner/get/agreementItem','ComponentBanner/getAgreementItem')->name('getAgreementItem');
    Route::post('componentBanner/get/usimItem','ComponentBanner/getUsimItem')->name('getUsimItem');
    Route::post('componentBanner/get/accessoriesItem','ComponentBanner/getAccessoriesItem')->name('getAccessoriesItem');
    Route::post('componentBanner/get/categoryItem','ComponentBanner/getCategoryItem')->name('getCategoryItem');
    Route::post('componentBanner/get/shopNewsItem','ComponentBanner/getShopNewsItem')->name('getShopNewsItem');


    //악세사리 카테고리
    Route::get('accessoriesCategory/:page/list','AccessoriesCategory/list')->name('getAccessoriesCategoryList');
    Route::post('accessoriesCategory','AccessoriesCategory/add')->name('addAccessoriesCategory');
    Route::post('accessoriesCategory/:id/update','AccessoriesCategory/update')->name('updateAccessoriesCategory');
    Route::post('accessoriesCategory/:id/updateStatus','AccessoriesCategory/updateStatus')->name('updateAccessoriesCategoryStatus');
    Route::post('accessoriesCategory/:id/delete','AccessoriesCategory/delete')->name('deleteAccessoriesCategory');

    //악세사리 서브카테고리
    Route::get('accessoriesSubCategory/:page/list','AccessoriesSubCategory/index')->name('getAccessoriesSubCategoryList');
    Route::post('accessoriesSubCategory/create','AccessoriesSubCategory/create')->name('addAccessoriesSubCategory');
    Route::post('accessoriesSubCategory/:id/update','AccessoriesSubCategory/update')->name('updateAccessoriesSubCategory');
    Route::post('accessoriesSubCategory/:id/delete','AccessoriesSubCategory/delete')->name('deleteAccessoriesSubCategory');
    Route::post('accessoriesSubCategory/:id/updateStatus','AccessoriesSubCategory/updateStatus')->name('updateAccessoriesSubCategoryStatus');

    //악세사리
    Route::get('accessories/:page/list','Accessories/index')->name('getAccessoriesList');
    Route::get('accessories/checkList/:page/list','Accessories/checkItemsList')->name('getCheckItemsList');
    Route::post('accessories/create','Accessories/add')->name('addAccessories');
    Route::post('accessories/:id/update','Accessories/update')->name('updateAccessories');
    Route::post('accessories/:id/delete','Accessories/delete')->name('deleteAccessories');
    Route::post('accessories/:id/updateStatus','Accessories/updateStatus')->name('updateAccessoriesStatus');
    Route::post('accessories/updateStatusAll','Accessories/checkUpdateStatus')->name('updateAccessoriesStatusAll');
    Route::post('accessories/deleteAll','Accessories/deleteAll')->name('deleteAllAccessories');
    Route::post('accessories/:id/banner','Accessories/updateBanner')->name('updateAccessoriesStatus');


    //악세사리 리뷰
    Route::get('accessories/review/:page/list','AccessoriesReview/index')->name('AccessoriesReviewList');
    Route::post('accessories/review/create','AccessoriesReview/add')->name('AccessoriesReview');
    Route::post('accessories/review/:id/delete','AccessoriesReview/delete')->name('AccessoriesGoodsReview');

    //매장 카테고리
    Route::get('shopCategory/:page/list','ShopCategory/list')->name('getShopCategoryList');
    Route::post('shopCategory','ShopCategory/add')->name('addShopCategory');
    Route::post('shopCategory/:id/update','ShopCategory/update')->name('updateShopCategory');
    Route::post('shopCategory/:id/updateStatus','ShopCategory/updateStatus')->name('updateShopCategoryStatus');
    Route::post('shopCategory/:id/delete','ShopCategory/delete')->name('deleteShopCategory');

    //매장부분
    Route::get('shop/:page/list','Shop/index')->name('getShopList');
    Route::post('shop/create','Shop/add')->name('addShop');
    Route::post('shop/:id/update','Shop/update')->name('updateShop');
    Route::post('shop/:id/delete','Shop/delete')->name('deleteShop');
    Route::post('shop/:id/updateStatus','Shop/updateStatus')->name('updateShopStatus');
    Route::post('shop/:id/banner','Shop/updateShopImg')->name('updateShopImg');

})->allowCrossDomain([
    "Access-Control-Allow-Headers"=>"token"
])->middleware(\app\admin\middleware\ManagerTokenCheck::class);