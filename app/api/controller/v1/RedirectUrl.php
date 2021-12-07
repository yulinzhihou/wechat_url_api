<?php
declare (strict_types = 1);

namespace app\api\controller\v1;

use app\api\controller\Base;
use app\api\model\RedirectUrl as UrlModel;
use think\facade\Cache;
use think\facade\Env;

/**
 * 直链生产类
 */
class RedirectUrl extends Base
{
    protected $model = null;

    protected $url;

    protected $setParams;

    public function initialize()
    {
        parent::initialize();
        $this->model = new UrlModel();
    }
    /**
     * 获取接口
     */
    public function getInfo():\think\Response\Json
    {
        $inputData = $this->request->param();
        if (isset($inputData['id'])) {
            $result = $this->model->getInfo($inputData['id']);
            if (!empty($result)) {
                $result['status'] = (bool)$result['status'];
                $result['qrcode_status'] = (bool)$result['qrcode_status'];
                $result['contact_status'] = (bool)$result['contact_status'];
//                $result['avatar'] = Env::get('CDN.url').'uploads/'.$result['avatar'];
//                $result['qrcode_url'] = Env::get('CDN.url').'uploads/'.$result['qrcode_url'];
                return $this->jsonR('获取成功',$result);
            }
        }
        return $this->jsonR('获取失败');
    }


    /**
     * 浏览量
     * @return \think\Response\Json
     */
    public function sendViewNum():\think\Response\Json
    {
        $inputData = $this->request->param();
        if (isset($inputData['id'])) {
            $data = [
                'id' => $inputData['id'],
                'type' => 'show_num',
            ];
            $result = $this->model->setFieldInc($data);
            return $this->jsonR('成功',$result);
        }
        return $this->jsonR('失败');
    }


    /**
     * 点击量
     */
    public function sendOpenNum():\think\Response\Json
    {
        $inputData = $this->request->param();
        if (isset($inputData['id'])) {
            $data = [
                'id' => $inputData['id'],
                'type' => 'click_num',
            ];
            $result = $this->model->setFieldInc($data);
            return $this->jsonR('成功',$result);
        }
        return $this->jsonR('失败');
    }


    public function setUrl()
    {
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
        // 获取token 缓存起来，再获取url_short
        $this->url = "https://api.weixin.qq.com/wxa/generate_urllink?access_token=".$accessToken;

        $shortUrl = $this->getTokenCurl(true);

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
