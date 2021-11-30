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
        $result = $this->model->getInfo($this->adminInfo['admin_id']);
        if (!empty($result)) {
            $result['roles'] = [$this->adminInfo['role_key']];
        }
        return $this->jsonR(['获取失败','获取成功'],$result);
    }


//    public function read()
//    {
//        $inputData = $this->request->param();
//
//
//        try {
//            $uid = request()->uid;  // 中间件传值，用户id
//            $role = request()->role_key;  // 中间件传值，角色组key
//            $result = $this->service->getInfoById($uid);  // 调用管理员服务中通过id获取用户信息方法
//            if ($result) {
//                $result['roles'] = [$role]; // 用户角色组
//                return success($result, 'success');
//            } else {
//                return error('未找到用户信息');
//            }
//        } catch (\Exception $e) {
//
//        }
//
//    }
}