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
})->allowCrossDomain();