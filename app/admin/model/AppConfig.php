<?php
declare (strict_types = 1);

namespace app\admin\model;


/**
 * 小程序配置模型
 */
class AppConfig extends Base
{
    protected $schema = [
        'id'	=>	'int',
        'app_id'	=>	'string',
        'admin_id'	=>	'int',
        'app_secret'	=>	'string',
        'logo'	=>	'string',
        'app_name'	=>	'string',
        'token'	=>	'string',
        'encoding_key'	=>	'string',
        'encode_type'	=>	'string',
        'api_url'	=>	'string',
        'create_time'	=>	'int',
        'update_time'	=>	'int'
    ];
}
