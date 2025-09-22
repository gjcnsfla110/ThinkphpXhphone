<?php
use think\facade\Route;
Route::setOption('complete_match', true);

Route::group(function () {
    //앱 메인페이지
    Route::get('index/main', 'MainPage/index')->name('getAppIndex');

    //앱 상품에 관련된 부분
    Route::post('goods/item','Goods/getOneGoods')->name('getAppGoods');
})->allowCrossDomain();