<?php
declare (strict_types = 1);

namespace app\admin\controller\v1;

use app\admin\controller\Base;
use app\admin\model\AppConfig as AppConfigModel;
use app\admin\validate\AppConfig as AppConfigValidate;

/**
 * 小程序配置控制类
 */
class AppConfig extends Base
{
    public function initialize()
    {
        parent::initialize();
        $this->params['admin_id'] = $this->adminInfo['admin_id'];
        if ($this->adminInfo['admin_id'] == 1) {
            $this->focus['admin_id'] = $this->adminInfo['admin_id'];
        }
        $this->model = new AppConfigModel();
        $this->validate = new AppConfigValidate();
    }
}
