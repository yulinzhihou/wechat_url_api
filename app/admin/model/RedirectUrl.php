<?php
declare (strict_types = 1);

namespace app\admin\model;


/**
 * 小程序项目直链模型
 */
class RedirectUrl extends Base
{

    /**
     * 获取小程序配置
     * @param $adminId
     * @return array
     */
    public function getAppConfig($adminId):array
    {
        return AppConfig::where('admin_id',$adminId)->findOrEmpty()->toArray();
    }
}
