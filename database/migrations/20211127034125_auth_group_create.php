<?php

use Phinx\Db\Adapter\MysqlAdapter;
use think\migration\Migrator;
use think\migration\db\Column;

class AuthGroupCreate extends Migrator
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
        $table = $this->table('auth_group',['engine'=>'innodb','charset'=>'utf8mb4','auto_increment'=>true,'comment'=>'用户组表']);
        $table
            ->addColumn('title','string',['limit'=>20,'null'=>false,'default'=>'','comment'=>'用户组中文名称'])
            ->addColumn('rules','string',['limit'=>255,'null'=>false,'default'=>'','comment'=>'用户组拥有的规则id'])
            ->addColumn('status','integer',['limit'=>MysqlAdapter::INT_TINY,'null'=>false,'default'=>1,'comment'=>'状态：为1正常，为0禁用'])
            ->setPrimaryKey('id')
            ->addIndex('id')
            ->create();
    }
}
