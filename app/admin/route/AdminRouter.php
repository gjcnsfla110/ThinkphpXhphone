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
    Route::post('image/delete_all','Image/delete')->name('deleteImage');
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

})->allowCrossDomain([
    "Access-Control-Allow-Headers"=>"token"
])->middleware(\app\admin\middleware\ManagerTokenCheck::class);