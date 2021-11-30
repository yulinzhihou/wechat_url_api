<?php
declare (strict_types = 1);

namespace app\admin\controller\v1;

use app\admin\controller\Base;
use app\admin\model\Role as RoleModel;
use app\admin\validate\Role as RoleValidate;

/**
 * 角色组控制器
 */
class Role extends Base
{
    public function initialize()
    {
        parent::initialize();
        $this->model = new RoleModel();
        $this->validate = new RoleValidate();
    }
}
