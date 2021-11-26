<?php
namespace app\api\model;

use think\Model;

/**
 * 直接模型
 */
class Url extends Model
{
    protected $createTime = 'created_at';

    protected $updateTime = 'updated_at';

    protected $defaultSoftDelete = 'deleted_at';

    protected $autoWriteTimestamp = true;

    protected $schema = [
        'id'	        =>	'int',
        'admin_id'	    =>	'string',
        'title'	        =>	'string',
        'head_image'	=>	'string',
        'nickname'	    =>	'string',
        'nickname_tips'	=>	'string',
        'qrcode_url'	=>	'string',
        'qrcode_title'	=>	'string',
        'qrcode_desc'	=>	'string',
        'phone_tips'	=>	'string',
        'phone_btn'	    =>	'string',
        'show_flag'	    =>	'int',
        'show_qrcode_tips'	=>	'int',
        'show_phone_tips'	=>	'int',
        'show_num'	    =>	'int',
        'click_num'	    =>	'int',
        'created_at'	=>	'timestamp',
        'updated_at'	=>	'timestamp',
        'deleted_at'	=>	'timestamp',
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
