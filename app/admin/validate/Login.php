<?php
declare (strict_types = 1);

namespace app\admin\validate;

use think\Validate;

class Login extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名' =>  ['规则1','规则2'...]
     *
     * @var array
     */
    protected $rule = [
        'username|用户名'  =>  'require',
        'password|密码'   =>  'require'
    ];

    /**
     * 定义错误信息
     * 格式：'字段名.规则名' =>  '错误信息'
     *
     * @var array
     */
    protected $message = [
        'username.require'  =>  '1000001|用户名,必填',
        'password.require'  =>  '1000002|密码,必填',
    ];


    protected $scene    = [
        'login'     =>  ['username','password'],
    ];
}
