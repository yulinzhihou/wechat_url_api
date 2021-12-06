<?php
use think\facade\Route;

/**
 * 接口V1版本
 */
return [
    /*直接接口*/
    Route::group('v1', function () {
        Route::group('url', function () {
            Route::post('index', 'RedirectUrl@index');
            Route::post('get_info', 'RedirectUrl@getInfo');
            Route::post('send_view', 'RedirectUrl@sendViewNum');
            Route::post('send_click', 'RedirectUrl@sendOpenNum');
        });
    })->prefix('app\api\controller\v1\\')->middleware([
        app\api\middleware\api::class
    ])
];