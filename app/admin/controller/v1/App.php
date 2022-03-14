<?php
declare (strict_types = 1);

namespace app\admin\controller\v1;

use app\admin\controller\Base;
use app\admin\model\App as AppModel;
use app\admin\validate\App as AppValidate;
use ParagonIE\EasyRSA\KeyPair;

/**
 * 接口系统请求配置
 */
class App extends Base
{
    public function initialize()
    {
        parent::initialize();
        if ($this->adminInfo['admin_id'] != 1) {
            $this->focus['admin_id'] = $this->adminInfo['admin_id'];
        }
        $this->model = new AppModel();
        $this->validate = new AppValidate();
    }


    /**
     * 显示指定的资源
     */
    public function read($id):\think\Response\Json
    {
        $inputData = $this->request->param();
        //额外增加请求参数
        if (!empty($this->params)) {
            $inputData = array_merge($inputData,$this->params);
        }
        if ($this->commonValidate(__FUNCTION__,$inputData)) {
            return json($this->message(true));
        }
        $result = $this->model->getInfo((int)$inputData['id']);
        $result['safety_domain'] = implode(',',json_decode($result['safety_domain'],true));
        return $this->jsonR(['获取失败','获取成功'],$result);
    }

    /**
     * 保存新建的资源
     */
    public function save():\think\Response
    {
        $inputData = $this->request->param();
        //取消传递过来的参数
        unset($inputData['app_id']);
        unset($inputData['app_secret']);
        unset($inputData['private_ssl']);
        unset($inputData['public_ssl']);
        //生成 appip
        $inputData['app_id'] = date('YmdHis',time()).mt_rand(10000,99999);
        $inputData['app_secret'] = md5(md5(base64_encode($inputData['app_id'])).$this->adminInfo['admin_id']);

        $keyPair = KeyPair::generateKeyPair(4096);

        $inputData['private_ssl'] = $keyPair->getPrivateKey()->getKey();
        $inputData['public_ssl'] = $keyPair->getPublicKey()->getKey();
        if ($this->commonValidate(__FUNCTION__,$inputData)) {
            return json($this->message(true));
        }
        //处理接口白名单
        if (false === strrpos($inputData['safety_domain'],',') && empty($inputData['safety_domain'])) {
            $inputData['safety_domain'] = json_encode([]);
        } else {
            $inputData['safety_domain'] = json_encode(explode(',',$inputData['safety_domain']));
        }
        $result = $this->model->addData($inputData);
        return $this->jsonR(['新增失败','新增成功'],$result);
    }

    /**
     * 保存更新的资源
     */
    public function update($id):\think\Response\Json
    {
        $inputData = $this->request->param();
        //取消传递过来的参数
        unset($inputData['app_id']);
        unset($inputData['app_secret']);
        unset($inputData['private_ssl']);
        unset($inputData['public_ssl']);
//        //生成 appip
//        $inputData['app_id'] = date('YmdHis',time()).mt_rand(10000,99999);
//        $inputData['app_secret'] = md5(md5(base64_encode($inputData['app_id'])).$this->adminInfo['admin_id']);
//
//        $keyPair = KeyPair::generateKeyPair(4096);
//
//        $inputData['private_ssl'] = $keyPair->getPrivateKey()->getKey();
//        $inputData['public_ssl'] = $keyPair->getPublicKey()->getKey();
//
        //处理接口白名单
        if (false === strrpos($inputData['safety_domain'],',') && empty($inputData['safety_domain'])) {
            $inputData['safety_domain'] = json_encode([]);
        } else {
            $inputData['safety_domain'] = json_encode(explode(',',$inputData['safety_domain']));
        }
        if ($this->commonValidate(__FUNCTION__,$inputData)) {
            return json($this->message(true));
        }
        $result = $this->model->editData($inputData);
        return $this->jsonR(['修改失败','修改成功'],$result);
    }

}
