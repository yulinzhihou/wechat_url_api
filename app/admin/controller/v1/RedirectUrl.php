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
        if ($this->adminInfo['admin_id'] != 1) {
            $this->focus['admin_id'] = $this->adminInfo['admin_id'];
        }
        $this->model = new RedirectUrlModel();
        $this->validate = new RedirectUrlValidate();
    }

    /**
     * 生成短链
     */
    public function getShortUrl():\think\Response\Json
    {
        $inputData = $this->request->param();
        $id = $inputData['id'] ?? 1;
        //管理员
        $adminId = $this->adminInfo['admin_id'];
        //获取小程序配置
        $appConfig = $this->model->getAppConfig($adminId);

        $acToken = '';
        if (!empty($appConfig)) {
            if (Cache::has($adminId.'-access_token') && Cache::has($inputData['id'].'-short-url')){
                $acToken = Cache::get($adminId.'-access_token');
            } else {
                $url = 'https://api.weixin.qq.com/cgi-bin/token?';//请求url
                $paramsArray = [
                    //微信授权类型,官方文档定义为 ： client_credential
                    'grant_type' => 'client_credential',
                    //你的appid
                    'appid' => $appConfig['app_id'],
                    //你的秘钥
                    'secret' => $appConfig['app_secret']
                ];
                $params = http_build_query($paramsArray);//生成URL参数字符串\
                $accessToken = $this->http($url.$params,[]);
                if (isset($accessToken['access_token'])) {
                    //表示请求成功
                    $acToken = $accessToken['access_token'];
                    Cache::set($adminId.'-access_token',$acToken,$accessToken['expires_in']);
                }
            }

            // 获取token 缓存起来，再获取url_short
            $urlData = [
                'path'          => 'pages/index/index',
                'query'         => 'id='.$inputData['id'].'&admin_id='.$adminId,
                'is_expire'     =>  true,
                'expire_type'   => 1,
                'expire_interval' => 1,
                /*release,develop,trial*/
                'env_version'   =>  'release'
            ];

            $this->url = "https://api.weixin.qq.com/wxa/generate_urllink?access_token=".$acToken;

            $shortUrl = $this->http($this->url,$urlData,true);
            if (isset($shortUrl['errcode']) && $shortUrl['errcode'] == 0) {
                $url = ['url' => $shortUrl['url_link']];
                //更新URL到数据库
                $data = [
                    'id' => $inputData['id'],
                    'short_link' => $shortUrl['url_link']
                ];
                Cache::set($inputData['id'].'-short-url',$data,$accessToken['expires_in']??30*86400);
                $ret = $this->model->editData($data);
            } else {
                $ret = false;
            }
            if ($ret) {
                return $this->jsonR('获取成功',[]);
            }
            return $this->jsonR('获取失败');
        }
        return $this->jsonR('小程序配置不正确，请检查后再进行获取');
    }
}
