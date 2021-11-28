<?php

use think\facade\Route;

return [
    Route::group('v1', function () {
        /*后台登录接口*/
        Route::group('login', function () {
            Route::post('login', 'Login@login');
            Route::post('logout', 'Login@logout');
        });

        /*后台管理员模块路由*/
        Route::group('admin', function () {
            Route::get('userinfo','admin@userInfo');
        });

        /*菜单组*/
        Route::group('routers', function () {
            Route::post('index','Routers@index');
        });

    })->prefix('app\admin\controller\v1\\')->middleware([
        app\admin\middleware\checkSign::class
    ])
];