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

    /**
     * 显示资源列表
     */
    public function index() :\think\Response
    {
        $result = $this->model->routersByTree($this->adminInfo['user_info']->role_id);
        if (!empty($result)) {
            //构建返回数据结构
            return $this->jsonR('获取成功',$result);
        }
        //构建返回数据结构
        return $this->jsonR('获取失败');
    }

}
