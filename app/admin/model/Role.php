<?php
declare (strict_types = 1);

namespace app\admin\model;

/**
 * 角色模型
 */
class Role extends Base
{
    protected $schema = [
        'id'	        =>	'int',
        'name'	        =>	'string',
        'rules'	        =>	'string',
        'key'	        =>	'string',
        'description'	=>	'string',
        'status'	    =>	'int',
        'create_time'	=>	'int',
        'update_time'	=>	'int'
    ];
}
