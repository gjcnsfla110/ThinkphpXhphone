<?php
use think\facade\Route;
Route::setOption('complete_match', true);

Route::group(function () {
    //앱 메인페이지
    Route::get('index/main', 'MainPage/index')->name('getAppIndex');

    //앱 상품에 관련된 부분
    Route::post('goods/item','Goods/getOneGoods')->name('getAppGoods');
    //메뉴카테고리에서 서브메뉴 클릭시 보여주는 리스트 데이터 갖고오부분
    Route::post('subMenuList/item/list','Goods/getSubMenuList')->name('getAppSubMenuList');

    //계약폰 카테고리
    Route::post('agreement/list','Agreement/getAgreementList',)->name('getAppAgreementList');
    Route::post('agreement/item/detail','Agreement/detailItem',)->name('getAppAgreementDetail');
    Route::post('agreement/plan/list','Agreement/getPlans',)->name('getAppAgreementPlanList');
    Route::post('agreement/review/list','Agreement/getReviewList',)->name('getAppReviewList');

    //후불유심/선불유심/유심개통
    Route::post('usim/list','Usim/usimList',)->name('getAppUsimList');
    Route::post('usim/detail','Usim/usimDetail',)->name('getAppUsimDetail');

    //악세사리 부분
    //메뉴카테고리에서 서브메뉴 클릭시 보여주는 리스트 데이터 갖고오부분
    Route::post('accessoriesSubCategory/accessories/list','Accessories/getSubCategoryList',)->name('getAppSubCategoryList');
    Route::post('accessories/item/detail','Accessories/getItem',)->name('getAccessoryDetail');
    Route::post('accessories/review/list','Accessories/getReviewList',)->name('getAccessoriesReviewList');

    //회사소개
    Route::post('shop/list','Shop/getShopList',)->name('getAppShopList');
    Route::post('shop/item/detail','Shop/getShopDate',)->name('getShopDate');

})->allowCrossDomain();