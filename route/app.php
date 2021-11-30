<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\facade\Route;

return [
    Route::miss(function(){
        return json([
            "status"    =>  999,
            'message'   =>  '未找到合适的路由，请联系后端小哥哥补接口',
            'method'    =>  request()->method(),
            'route'     =>  request()->url(),
            'create_time'   =>  time(),
            'date_time'     =>  date("Y-m-d H:i:s",time())
        ]);
    })
];