<?php

use think\facade\Route;

return [
    Route::group('url', function () {
        Route::post('index', 'app\api\controller\Url@index');
        Route::post('get_info', 'app\api\controller\Url@getInfo');
        Route::post('send_view', 'app\api\controller\Url@sendViewNum');
        Route::post('send_click', 'app\api\controller\Url@sendOpenNum');
    })
];