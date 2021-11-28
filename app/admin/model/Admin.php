<?php
declare (strict_types = 1);

namespace app\admin\model;

use think\facade\Log;

/**
 * 后台管理员基类
 */
class Admin extends Base
{
    /**
     * 获取用户
     * @param array $data
     * @return array
     */
    public function getUserInfo(array $data) : array
    {
        try {
            $result = $this->where($data)->find();
            return $result ? $result->toArray() : [];
        } catch (\Exception $e) {
            Log::sql($e->getMessage(),$e->getTrace());
            return [];
        }
    }


}
