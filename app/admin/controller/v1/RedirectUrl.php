<?php
declare (strict_types = 1);

namespace app\admin\controller\v1;

use app\admin\controller\Base;
use app\admin\model\RedirectUrl as RedirectUrlModel;
use app\admin\validate\RedirectUrl as RedirectUrlValidate;

/**
 * 小程序直链控制器
 */
class RedirectUrl extends Base
{
    public function initialize()
    {
        parent::initialize();
        $this->model = new RedirectUrlModel();
        $this->validate = new RedirectUrlValidate();
    }
}
