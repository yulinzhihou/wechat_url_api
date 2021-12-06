<?php

namespace app\api\middleware;

/**
 * 接口中间件
 */
class Api
{
    /**
     * 处理请求
     * @param \think\Request $request
     * @param \Closure $next
     */
    public function handle(\think\Request $request, \Closure $next)
    {
        //获取appid
        $appId = $request->param('app_id');
        $apiModel = (new \app\api\model\App());
        $app = $apiModel->where('app_id',$appId)->findOrEmpty()->toArray();
        if (empty($app)) {
            return json(['message'=>'appId非法，请检查核对','data'=>[]],504);
        }
        //检测域名是否合法
//        $domain = request()->host();
        $refer = request()->header('referer');
        $arr = explode('/',$refer);
        $domain = $arr[2];
//        dump($arr);
//        dd($domain);
        $safetyDomain = json_decode($app['safety_domain'],true);
        if (!in_array($domain,$safetyDomain)) {
            return json(['message'=>'非安全域名，请检查接口域名白名单。当前被拒绝域名:'.$domain,'data'=>[]],504);
        }
        //过滤OPTIONS请求
        if ( $_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            header("Access-Control-Allow-Origin: ".implode(',',$safetyDomain));
            header("Access-Control-Allow-Headers:Authorization,Content-Type,If-Match,If-Modified-Since,If-None-Match,If-Unmodified-Since,X-Requested-With,x_requested_with,X-token");
            header('Access-Control-Allow-Methods: GET, POST, PUT,DELETE,OPTIONS,PATCH,OPTIONS');
            exit;
        }
        header('Access-Control-Allow-Headers: Authorization, Content-Type, If-Match, If-Modified-Since, If-None-Match, If-Unmodified-Since, X-CSRF-TOKEN, X-Requested-With,X-token');
        header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE');
        header('Access-Control-Allow-Origin: '.implode(',',$safetyDomain));

        return $next($request);
    }
}