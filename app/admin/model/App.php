<?php
declare (strict_types = 1);

namespace app\admin\model;


/**
 * 接口系统模型
 * @mixin \think\Model
 */
class App extends Base
{
    protected $schema = [
        'id'	=>	'int',
        'app_code'	=>	'string',
        'app_name'	=>	'string',
        'app_desc'	=>	'string',
        'app_id'	=>	'string',
        'app_secret'	=>	'string',
        'safety_domain'	=>	'string',
        'public_ssl'	=>	'string',
        'private_ssl'	=>	'string',
        'create_time'	=>	'int',
        'update_time'	=>	'int'
    ];
}
