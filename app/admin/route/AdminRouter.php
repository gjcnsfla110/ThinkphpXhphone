<?php
use think\facade\Route;

Route::group(function(){
    Route::get('login','Manager/login')->name('login');
    Route::get('captcha','Capcha/getCaptcha')->name('captcha');
})->allowCrossDomain();