<?php
// 这是系统自动生成的公共文件

if (!function_exists('tree')) {
    /**
     * 以pid——id对应，生成树形结构
     * @param array $array
     * @return array|bool
     */
    function tree(array $array):array
    {
        $tree = [];     // 生成树形结构
        $newArray = []; // 中转数组，将传入的数组转换

        if (!empty($array)) {
            foreach ($array as $item) {
                $newArray[$item['id']] = $item;  // 以传入数组的id为主键，生成新的数组
            }
            foreach ($newArray as $k => $val) {
                if ($val['pid'] > 0) {           // 默认pid = 0时为一级
                    $newArray[$val['pid']]['children'][] = &$newArray[$k];   // 将pid与主键id相等的元素放入children中
                } else {
                    $tree[] = &$newArray[$val['id']];   // 生成树形结构
                }
            }
            return $tree;
        } else {
            return [];
        }
    }
}
