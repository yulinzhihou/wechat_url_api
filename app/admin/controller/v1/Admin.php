<?php

namespace app\admin\controller\v1;

use app\admin\controller\Base;
use app\admin\model\Admin as AdminModel;
use app\admin\validate\Admin as AdminValidate;
/**
 * 后台管理员类
 */
class Admin extends Base
{
    public function initialize()
    {
        parent::initialize();
        $this->model = new AdminModel();
        $this->validate = new AdminValidate();
    }

    /**
     * 获取用户详情
     */
    public function userInfo():\think\Response\Json
    {
        $inputData = $this->request->param();
        if ($this->commonValidate(__FUNCTION__,$inputData)) {
            return json($this->message(true));
        }
        $this->model->field = ['id','username','phone','email','avatar','status','create_time','update_time'];
        if (isset($this->adminInfo['admin_id']) && !empty($this->adminInfo['admin_id'])) {
            $result = $this->model->getInfo($this->adminInfo['admin_id']);
            if (!empty($result)) {
                $result['roles'] = [$this->adminInfo['role_key']];
            }
            return $this->jsonR(['获取失败','获取成功'],$result);
        }
        return $this->jsonR('用户信息已经过期，请重新登录');
    }
}