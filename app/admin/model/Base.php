<?php
declare (strict_types = 1);

namespace app\admin\model;

use think\facade\Log;
use think\Model;

/**
 * 后台模型基类
 */
class Base extends Model
{
    /**
     * 查看列表数据
     * @param int $page 分页页码
     * @param int $pageSize 分页类目数量
     * @param array $field 需要输入的字段，默认为全部输出，筛选表字段
     * @param array $vague 需要进行模糊查询的字段，如： a like %a%
     * @param array $focus 精确搜索条件，如a=1,b=2这种精确等于某个值的
     * @param array $order 排序字段，如：['id'=>'desc','sort'=>'desc']
     * @return array
     */
    public function getIndexList(int $page,int $pageSize,array $field = [], array $vague = [],array $focus = [],array $order = []):array
    {
        try {
            $fields = array_keys($this->schema);
            $collection = $this->field($field)->where(function ($query) use ($fields,$focus) {
                //精准查询
                if (!empty($focus)) {
                    foreach ($focus as $key => $item) {
                        if (in_array($key,$fields)) {
                            $query->where($key,$item);
                        }
                    }
                }
            })->where(function($query) use ($fields,$vague) {
                //模糊查询
                if (!empty($vague)) {
                    foreach ($vague as $key => $item) {
                        if (in_array($key,$fields)) {
                            $query->whereOr($key,'like',"%".$item."%");
                        }
                    }
                }
            })->order($order);
            //判断是否需要分页
            if (0 == $page || 0 == $pageSize) {
                //不需要分页
                return $collection->select()->toArray();
            } else {
                //需要分布
                $totalNum = $collection->count();
                $data = $collection->page($page)->limit($pageSize)->select()->toArray();;
                return ['count'=>$totalNum,'data'=>$data];
            }
        } catch (\Exception $e) {
            Log::sql($e->getMessage(),$e->getTrace());
            return [];
        }

    }

    /**
     * 新增数据
     * @param array $data
     * @return bool
     */
    public function addData(array $data) : bool
    {
        try {
            $result = $this->create($data);
            return (bool)$result;
        } catch (\Exception $e) {
            Log::sql($e->getMessage(),$e->getTrace());
            return false;
        }
    }

    /**
     * 编辑数据
     * @param array $data
     * @return bool
     */
    public function editData(array $data) : bool
    {
        try {
            if (isset($data['id']) && $data['id'] > 0) {
                $result = $this->find($data['id']);
                return $result && $result->save($data);
            }
            return false;
        } catch (\Exception $e) {
            Log::sql($e->getMessage(),$e->getTrace());
            return false;
        }
    }

    /**
     * 获取详情
     * @param array $data
     * @return array
     */
    public function getInfo(array $data) : array
    {
        try {
            if (isset($data['id'])) {
                $result = $this->field($this->field)->find($data['id']);
                return $result ? $result->toArray() : [];
            }
            return [];
        } catch (\Exception $e) {
            Log::sql($e->getMessage(),$e->getTrace());
            return [];
        }
    }

    /**
     * 删除
     * @param array $data
     * @return bool
     */
    public function delData(array $data) : bool
    {
        try {
            if (isset($data['id'])) {
                $result = $this->find($data['id']);
                return $result && $result->delete();
            }
            return false;
        } catch (\Exception $e) {
            Log::sql($e->getMessage(),$e->getTrace());
            return false;
        }
    }

    /**
     * 通过ID获取数据
     * @param $ids
     * @return array
     */
    public function getExportData($ids): array
    {
        try {
            $result = $this->whereIn($this->pk,$ids['ids'])->order('create_time','desc')->select();
            return $result ? $result->toArray() : [];
        } catch (\Exception $e) {
            Log::sql($e->getMessage(),$e->getTrace());
            return [];
        }
    }

    /**
     * 通过主键进进行字段值的增加
     * @param string $field
     * @param int $id
     * @param int $value
     * @return bool
     */
    public function setInc(string $field,int $id,int $value = 1): bool
    {
        try {
            $result = $this->findOrEmpty($id);
            if (!empty($result)) {
                $newValue = $result[$field] + $value;
                $res = $result->save([$field=>$newValue]);
                return (bool)$res;
            }
            return false;
        } catch (\Exception $e) {
            Log::sql($e->getMessage(),$e->getTrace());
            return false;
        }
    }

    /**
     * 通过主键进进行字段值的减少
     * @param string $field
     * @param int $id
     * @param int $value
     * @return bool
     */
    public function setDec(string $field,int $id,int $value = 1): bool
    {
        try {
            $result = $this->findOrEmpty($id);
            if (!empty($result)) {
                $newValue = $result[$field] - $value;
                $res = $result->save([$field=>$newValue]);
                return (bool)$res;
            }
            return false;
        } catch (\Exception $e) {
            Log::sql($e->getMessage(),$e->getTrace());
            return false;
        }
    }

    /**
     * 批量修改
     * @param $data
     * @return bool
     */
    public function batchEditData($data):bool
    {
        try {
            $result = $this->saveAll($data);
            return (bool)$result;
        } catch (\Exception $e) {
            Log::sql($e->getMessage(),$e->getTrace());
            return false;
        }
    }

    /**
     * 批量删除
     * @param array $data
     * @return bool
     */
    public function batchDelData(array $data) : bool
    {
        try {
            $res = true;
            foreach ($data as $item) {
                if (isset($item['id']) && $item['id'] > 0) {
                    $result = $this->find($item['id']);
                    $result = $result->delete();
                    $res = $res && $result;
                }
            }
            return $res;
        } catch (\Exception $e) {
            Log::sql($e->getMessage(),$e->getTrace());
            return false;
        }
    }
}
