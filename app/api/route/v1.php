<?php
use think\facade\Route;

/**
 * 接口V1版本
 */
return [
    /*直接接口*/
    Route::group('v1', function () {
        Route::group('url', function () {
            Route::post('index', 'Url@index');
            Route::post('get_info', 'Url@getInfo');
            Route::post('send_view', 'Url@sendViewNum');
            Route::post('send_click', 'Url@sendOpenNum');
        });
    })->prefix('app\api\controller\v1\\')->middleware([
        app\api\middleware\api::class
    ])
];