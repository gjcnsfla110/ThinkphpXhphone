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

    //이미지 클래스(image_class) 부분
    Route::post("image_class","ImageClass/save")->name('createImageClass');
    Route::get('image_class/:page','ImageClass/index')->name('getImageClassList');
    Route::get('image_class/:id/images/:page$','ImageClass/imagesList')->name('getImagesList');
    Route::post('image_class/all','ImageClass/all')->name('getAllImageClass');


    //이미지 (image)부분
    Route::post('image/upload','Image/save')->name('uploadImage');
    Route::post('image/delete_all','Image/delete')->name('deleteImage');
    Route::post('image/:id','Image/update')->name('updateImage');


})->allowCrossDomain([
    "Access-Control-Allow-Headers"=>"token"
])->middleware(\app\admin\middleware\ManagerTokenCheck::class);