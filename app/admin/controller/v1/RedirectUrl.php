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
        Cache::set('inputData',$inputData,300);
        $this->url = 'https://api.weixin.qq.com/cgi-bin/token';//请求url
        $paramsArray = [
            //你的appid
            'appid' => 'wxfddfkjs54g5r5d5sdsf',
            //你的秘钥
            'secret' => 'krj9er9df883kjd4j5k435jk34fddf',
            //微信授权类型,官方文档定义为 ： client_credential
            'grant_type' => 'client_credential'
        ];
        $this->setParams = http_build_query($paramsArray);//生成URL参数字符串
        $accessToken  = $this->getTokenCurl();
        Cache::set('access_token',$accessToken,300);
        // 获取token 缓存起来，再获取url_short
        $this->url = "https://api.weixin.qq.com/wxa/generate_urllink?access_token=".$accessToken;

        $shortUrl = $this->getTokenCurl(true);

        Cache::set('short_url',$shortUrl,300);

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
            curl_setopt($ch, CURLOPT_POSTFIELDS, $this->params);
            curl_setopt($ch, CURLOPT_URL, $this->url);
        } else {
            if ($this->params) {
                curl_setopt($ch, CURLOPT_URL, $this->url . '?' . $this->params);
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
