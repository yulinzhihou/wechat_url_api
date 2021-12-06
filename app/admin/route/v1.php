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
            Route::get('userinfo','Admin@userInfo');
            Route::post('upload','Admin@upload');
        });
        Route::resource('admin','Admin')->expect(['create','edit']);

        /*菜单组*/
        Route::resource('routes','Routers')->expect(['create','edit']);

        /*角色组*/
        Route::resource('role','Role')->expect(['create','edit']);

        /*管理员组*/
        Route::resource('admin','Admin')->expect(['create','edit']);

        /*小程序配置*/
        Route::group('app_config', function () {
            Route::post('upload', 'AppConfig@upload');
        });
        Route::resource('app_config','AppConfig')->expect(['create','edit']);

        /*公众号配置*/
        Route::group('mp_config', function () {
            Route::post('upload', 'MpConfig@upload');
        });
        Route::resource('mp_config','MpConfig')->expect(['create','edit']);

        /*直链配置*/
        Route::group('redirect_url', function () {
            Route::post('upload', 'RedirectUrl@upload');
        });
        Route::resource('redirect_url','RedirectUrl')->expect(['create','edit']);

        /*接口管理系统*/
        Route::group('app', function () {
            Route::post('upload', 'App@upload');
        });
        Route::resource('app','App')->expect(['create','edit']);


    })->prefix('app\admin\controller\v1\\')->middleware([
        app\admin\middleware\checkSign::class
    ]),

    Route::miss(function(){
        return json([
            "status"    =>  504,
            'message'   =>  '路由地址未定义,不支持直接请求，请使用正确的接口地址和参数，请联系后端小哥哥',
            'method'    =>  request()->method(),
            'route'     =>  request()->url(),
            'create_time'   =>  time(),
            'date_time'     =>  date("Y-m-d H:i:s",time())
        ]);
    })
];