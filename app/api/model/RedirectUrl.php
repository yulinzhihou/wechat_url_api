<?php
namespace app\api\model;

use think\Model;

/**
 * 直接模型
 */
class RedirectUrl extends Model
{
    protected $createTime = 'created_at';

    protected $updateTime = 'updated_at';

    protected $defaultSoftDelete = 'deleted_at';

    protected $autoWriteTimestamp = true;

    protected $schema = [
        'id'	        =>	'int',
        'admin_id'	    =>	'int',
        'title'	        =>	'string',
        'avatar'	    =>	'string',
        'nickname'	    =>	'string',
        'user_brief'	=>	'string',
        'qrcode_url'	=>	'string',
        'qrcode_title'	=>	'string',
        'qrcode_desc'	=>	'string',
        'qrcode_content'=>	'string',
        'contact'	    =>	'string',
        'contact_title'	=>	'string',
        'status'	    =>	'int',
        'qrcode_status'	=>	'int',
        'contact_status'=>	'int',
        'show_num'	    =>	'int',
        'short_link'	=>	'string',
        'click_num'	    =>	'int',
        'create_time'	=>	'int',
        'update_time'	=>	'int',
    ];

    /**
     * 获取详情
     * @param $id
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getInfo($id): array
    {
        $result = $this->find($id);
        return $result ? $result->toArray() : [];
    }

    /**
     * 编辑数据
     * @param array $data
     * @return bool
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function setFieldInc(array $data) : bool
    {
        if (isset($data['id']) && $data['id'] > 0) {
            $result = $this->find($data['id']);
            $tmp = $result[$data['type']];
            return $result->save([$data['type']=>$tmp+1]);
        }
        return false;
    }
}
