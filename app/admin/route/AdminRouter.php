<?php
use think\facade\Route;

Route::group(function(){
    Route::post('login','Manager/login')->name('login');
    Route::get('join','Manager/in')->name('join');
})->allowCrossDomain();