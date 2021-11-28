<?php

use Phinx\Db\Adapter\MysqlAdapter;
use think\migration\Migrator;
use think\migration\db\Column;

class RouteCreate extends Migrator
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $table = $this->table('routers',['engine'=>'innodb','charset'=>'utf8mb4','auto_increment'=>true,'comment'=>'路由表']);
        $table
            ->addColumn('pid','integer',['limit'=>11,'signed'=>false,'null'=>false,'default'=>0,'comment'=>'父id（二级路由）'])
            ->addColumn('title','string',['limit'=>32,'null'=>false,'default'=>'','comment'=>'路由名称'])
            ->addColumn('path','string',['limit'=>128,'null'=>false,'default'=>'','comment'=>'路由地址'])
            ->addColumn('component','string',['limit'=>128,'null'=>false,'default'=>'','comment'=>'组件地址'])
            ->addColumn('icon','string',['limit'=>128,'null'=>false,'default'=>'','comment'=>'图标'])
            ->addColumn('redirect','string',['limit'=>128,'null'=>false,'default'=>'','comment'=>'重定向地址'])
            ->addColumn('always_show','integer',['limit'=>MysqlAdapter::INT_TINY,'null'=>false,'default'=>0,'comment'=>'总是显示：1是，0否'])
            ->addColumn('hidden','integer',['limit'=>MysqlAdapter::INT_TINY,'null'=>false,'default'=>0,'comment'=>'是否隐藏：1是，0否'])
            ->addColumn('affix','integer',['limit'=>MysqlAdapter::INT_TINY,'null'=>false,'default'=>0,'comment'=>'是否固定：1是，0否'])
            ->addColumn('no_cache','integer',['limit'=>MysqlAdapter::INT_TINY,'null'=>false,'default'=>0,'comment'=>'是否缓存：1是，0否'])
            ->addColumn('sort','integer',['limit'=>MysqlAdapter::INT_TINY,'null'=>false,'default'=>0,'comment'=>'排序：0-99'])
            ->addColumn('status','integer',['limit'=>MysqlAdapter::INT_TINY,'null'=>false,'default'=>1,'comment'=>'状态：为1正常，为0禁用'])
            ->addColumn('create_time','integer',['limit'=>11,'signed'=>false,'null'=>false,'default'=>0,'comment'=>'创建时间'])
            ->addColumn('update_time','integer',['limit'=>11,'signed'=>false,'null'=>false,'default'=>0,'comment'=>'更新时间'])
            ->setPrimaryKey('id')
            ->addIndex('id')
            ->create();
    }
}
