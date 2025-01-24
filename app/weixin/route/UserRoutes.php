<?php

use think\facade\Route;

Route::group(function () {
    Route::get('login','User/login')->name('login');
});