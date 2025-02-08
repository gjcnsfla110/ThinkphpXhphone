<?php
use think\facade\Route;

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

    //이미지 클래스(image_class) 부분
    Route::post("image_class","ImageClass/save")->name('createImageClass');

})->allowCrossDomain([
    "Access-Control-Allow-Headers"=>"token"
])->middleware(\app\admin\middleware\ManagerTokenCheck::class);