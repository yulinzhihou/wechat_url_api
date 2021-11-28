<?php

namespace  app\library;

/**
 * 高级数组处理类
 */
trait YArray
{
    /**
     * 获取数组层级，确定是几维数组
     * @return int
     */
    public function getArrayLevel():int
    {
        return 2;
    }

    /**
     * 通过键名取值
     * @param array $data
     * @param string $key
     * @return string
     */
    public function getValueByKey(array $data,string $key):string
    {
        return '';
    }


    /**
     * 通过键名取一组值
     * @param array $data
     * @param string $key
     * @return array
     */
    public function getValuesByKey(array $data,string $key):array
    {
        return [];
    }

    /**
     * 通过值取键名
     * @param array $data
     * @param string $value
     * @return string
     */
    public function getKeyByValue(array $data,string $value):string
    {
        return '';
    }

}