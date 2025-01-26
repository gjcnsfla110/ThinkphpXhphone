<?php
use think\facade\Route;

Route::group(function(){
    Route::post('login','Manager/login')->name('login');
    Route::get('join','Manager/addM')->name('join');
    Route::get('test','Manager/test')->name('test');
})->allowCrossDomain();

Route::group(function(){
    Route::post('getInfo','Manager/getInfo')->name('getInfo');
})->allowCrossDomain([
    "Access-Control-Allow-Headers"=>"token"
])->middleware(\app\admin\middleware\HasManagerToken::class);