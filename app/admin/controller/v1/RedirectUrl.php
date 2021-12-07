<?php
declare (strict_types = 1);

namespace app\admin\controller\v1;

use app\admin\controller\Base;
use app\admin\model\RedirectUrl as RedirectUrlModel;
use app\admin\validate\RedirectUrl as RedirectUrlValidate;
use think\facade\Cache;

/**
 * 小程序直链控制器
 */
class RedirectUrl extends Base
{
    protected $url;

    protected $setParams;

    public function initialize()
    {
        parent::initialize();
        $this->model = new RedirectUrlModel();
        $this->validate = new RedirectUrlValidate();
    }




    public function getShortUrl()
    {
        $inputData = $this->request->param();
        //管理员
        $adminId = $this->adminInfo['admin_id'];
        //获取小程序配置
        $appConfig = $this->model->getAppConfig($adminId);

        $acToken = '';
        if (!empty($appConfig)) {
            if (Cache::has($adminId.'-access_token')) {
                $acToken = Cache::get($adminId.'-access_token');
            } else {
                $this->url = 'https://api.weixin.qq.com/cgi-bin/token';//请求url
                $paramsArray = [
                    //微信授权类型,官方文档定义为 ： client_credential
                    'grant_type' => 'client_credential',
                    //你的appid
                    'appid' => $appConfig['app_id'],
                    //你的秘钥
                    'secret' => $appConfig['app_secret']
                ];
                $this->setParams = http_build_query($paramsArray);//生成URL参数字符串
                $accessToken = json_decode($this->getTokenCurl(),true);
                if (isset($accessToken['access_token'])) {
                    //表示请求成功
                    $acToken = $accessToken['access_token'];
                    Cache::set($adminId.'-access_token',$acToken,$accessToken['expires_in']);
                }
            }

            // 获取token 缓存起来，再获取url_short
            $urlData = [
                'page'          => 'pages/index/index',
                'query'         => 'id=1&admin_id=1',
                'is_expire'     =>  true,
                'expire_type'   => 1,
                'expire_interval' => 1,
                'expire_time'   => 180 * 3600 * 24,
                'env_release'   =>  'develop',/*release,develop,trial*/
            ];


            $this->url = "https://api.weixin.qq.com/wxa/generate_urllink?access_token=".$acToken;
            $this->setParams = $urlData;

            $shortUrl = json_decode($this->getTokenCurl(true),true);
//            $shortUrl = $this->http($this->url,$urlData,true);
            Cache::set('short_url',$shortUrl,300);

            return $this->jsonR('获取成功',$shortUrl);
        }
        return $this->jsonR('小程序配置不正确，请检查后再进行获取');


    }


    public function getTokenCurl($ispost = false)
    {
        $httpInfo = array();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.118 Safari/537.36');
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if ($ispost) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $this->setParams);
            curl_setopt($ch, CURLOPT_URL, $this->url);
        } else {
            if ($this->setParams) {
                curl_setopt($ch, CURLOPT_URL, $this->url . '?' . $this->setParams);
            } else {
                curl_setopt($ch, CURLOPT_URL, $this->url);
            }
        }
        $response = curl_exec($ch);
        if ($response === FALSE) {
            return false;
        }
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $httpInfo = array_merge($httpInfo, curl_getinfo($ch));
        Cache::set('http-info',$httpInfo,200);
        Cache::set('http-code',$httpCode,200);
        Cache::set('response',$response,300);
        curl_close($ch);
        return $response;
    }
}
