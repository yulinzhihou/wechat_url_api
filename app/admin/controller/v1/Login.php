<?php

namespace app\admin\controller\v1;

use app\admin\controller\Base;

use app\admin\model\Admin as AdminModel;
use app\admin\model\Role as RoleModel;
use app\library\JwtUtil;
use think\facade\Cache;
use app\admin\validate\Login as LoginValidate;

/**
 * 后台登录控制器
 */
class Login extends Base
{
    /**
     * 后台管理员控制器
     * @var null
     */
    protected $validate = null;

    /**
     * 定义管理员模型
     * @var null
     */
    protected $adminModel = null;

    /**
     * 角色模型
     * @var null
     */
    protected $roleModel = null;

    /**
     * 初始化方法
     */
    public function initialize()
    {
        parent::initialize();
        $this->adminModel = new AdminModel();
        $this->validate = new LoginValidate();
        $this->roleModel = new RoleModel();
    }


    /**
     * 登录
     */
    public function login(): \think\response\Json
    {
        $inputData = $this->request->param(['username','password']);

        //额外增加请求参数
        if (!empty($this->params)) {
            $inputData = array_merge($inputData,$this->params);
        }
        if ($this->commonValidate(__FUNCTION__,$inputData)) {
            return json($this->message(true));
        }
        //获取用户信息
        $userInfo = $this->adminModel->getUserInfo(['username'=>$inputData['username']]);
        if (!empty($userInfo)) {
            if ($userInfo['status'] === 0) {
                return $this->jsonR('用户已经禁用');
            }
            $password = md5(md5($inputData['password']) . $userInfo['salt']); // 加密密码，（与新增管理员加密方式一致）
            if ($userInfo['password'] != $password) {
                return $this->jsonR('用户密码不正确');
            }

            if ($userInfo['role_id'] === 0) {
                return $this->jsonR('用户角色不存在，请联系系统管理员');
            }
            // 以上验证都通过后对管理员签发登录证书
            $roleInfo = $this->roleModel->getInfo($userInfo['role_id'],['status'=>1]); // 获取角色组key
            if (empty($roleInfo)) {
                return $this->jsonR('角色信息不正确');
            }

            $jwt = JwtUtil::issue($userInfo['id'], $roleInfo['key'],$userInfo);  // 调用jwt工具类中issue()方法，传入用户ID，模拟传入角色组关键词
            Cache::set('admin_info',$jwt,3600);
            return $this->jsonR('登录成功',['token'=>$jwt]);// 返回登录token
        } else {
            return $this->jsonR('用户不存在');
        }
    }

    /**
     * 单点注销，退出登录
     */
    public function logout(): \think\response\Json
    {
        return $this->jsonR('退出登录');
    }
}