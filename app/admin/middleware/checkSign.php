<?php

namespace app\admin\middleware;

use app\library\JwtUtil;
use think\Cache;
use think\facade\Config;
use think\facade\Env;
use think\response\Json;

class checkSign
{
    /**
     * 处理请求
     * @param \think\Request $request
     * @param \Closure $next
     * @return Json
     */
    public function handle(\think\Request $request, \Closure $next):\think\Response\Json
    {
        //过滤OPTIONS请求
        if ( $_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            header("Access-Control-Allow-Origin: *");
            header("Access-Control-Allow-Headers:Authorization,Content-Type,If-Match,If-Modified-Since,If-None-Match,If-Unmodified-Since,X-Requested-With,x_requested_with,X-token");
            header('Access-Control-Allow-Methods: GET, POST, PUT,DELETE,OPTIONS,PATCH,OPTIONS');
            exit;
        }
        header('Access-Control-Allow-Headers: Authorization, Content-Type, If-Match, If-Modified-Since, If-None-Match, If-Unmodified-Since, X-CSRF-TOKEN, X-Requested-With,X-token');
        header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE');
        header('Access-Control-Allow-Origin: *');

        $whitelist = Config::get('whitelist');
        $route = request()->pathinfo();
        if (!in_array($route, $whitelist)) { // 对登录控制器放行
            $token = request()->header('X-token');  // 前端请求携带的Token信息
            $jwt = JwtUtil::verification(Env::get('app_key','test'), $token); // 与签发的key一致
            \think\facade\Cache::set('jwt',$jwt,200);
            if ($jwt['status'] == 200) {
                $request->uid = $jwt['data']->data->uid; // 传入登录用户ID
                $request->role_key = $jwt['data']->data->role; // 传入登录用户角色组key
            } else {
                return $jwt;
            }
        }
        return $next($request);
    }
}