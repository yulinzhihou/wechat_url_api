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

}
