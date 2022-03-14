<?php
declare (strict_types = 1);

namespace app\admin\model;


/**
 * 小程序项目直链模型
 */
class RedirectUrl extends Base
{
    protected $schema = [
        'id'	    =>	'int',
        'admin_id'	=>	'int',
        'title'	    =>	'string',
        'avatar'	=>	'string',
        'nickname'	=>	'string',
        'user_brief'	=>	'string',
        'qrcode_url'	=>	'string',
        'qrcode_title'	=>	'string',
        'qrcode_desc'	=>	'string',
        'qrcode_content'	=>	'string',
        'contact'	=>	'string',
        'contact_title'	=>	'string',
        'status'	=>	'int',
        'qrcode_status'	=>	'int',
        'contact_status'	=>	'int',
        'show_num'	=>	'int',
        'short_link'	=>	'string',
        'click_num'	=>	'int',
        'create_time'	=>	'int',
        'update_time'	=>	'int'
    ];

    /**
     * 获取小程序配置
     * @param $adminId
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getAppConfig($adminId):array
    {
        $data = AppConfig::where('admin_id',$adminId)->select()->toArray();
        if (count($data) > 0 ) {
            return $data[0];
        }
        return [];
    }
}
