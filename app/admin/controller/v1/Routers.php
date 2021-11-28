<?php
declare (strict_types = 1);

namespace app\admin\controller\v1;

use app\admin\controller\Base;
use app\admin\model\Routers as RoutersModel;
use app\admin\validate\Routers as RoutersValidate;

/**
 * 路由组控制器
 */
class Routers extends Base
{
    public function initialize()
    {
        parent::initialize();
        $this->model = new RoutersModel();
        $this->validate = new RoutersValidate();
    }


}
