<?php
declare (strict_types = 1);

namespace app\admin\model;

use think\facade\Log;

/**
 * 菜单模型
 */
class Routers extends Base
{
    /**
     * 通过角色ID获取菜单权限
     * @param $roleId
     * @return array
     */
    public function routersByTree($roleId):array
    {
        try {
            $role = (new Role())->getInfo($roleId);
            $where[] = $role['rules'] == '*' ? true : ['id', 'in', explode(',', $role['rules'])];
            $order = ['sort' => 'desc'];  // 按排序序号由大到小排序（0-99）
            $result = $this->where($where)->order($order)->select()->toArray();
            return tree($result);
        } catch (\Exception $e) {
            Log::sql($e->getMessage(),$e->getTrace());
            return [];
        }
    }


    /**
     * 通过规则获取菜单
     * @param string $rules 规则ID
     * @return array
     */
    public function routersByRules(string $rules):array
    {
        try {
            $where = [];
            // 如果角色组rules为*,则代表拥有所有路由访问权限
            if ($rules != '*') {
                $where[] = ['id', 'in', explode(',', $rules)]; // 查询条件
            }
            $routes = $this->where($where)->select()->toArray();
            if (!empty($routes) && is_array($routes)) {
                $routes = tree($routes);  // 将路由转换为树形结构
            }
            return $routes;
        } catch (\Exception $e) {
            Log::sql($e->getMessage(),$e->getTrace());
            return [];
        }

    }
}
