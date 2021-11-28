<?php

use Phinx\Db\Adapter\MysqlAdapter;
use think\migration\Migrator;
use think\migration\db\Column;

class AuthRuleCreate extends Migrator
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
        $table = $this->table('auth_rule',['engine'=>'innodb','charset'=>'utf8mb4','auto_increment'=>true,'comment'=>'规则表']);
        $table
            ->addColumn('name','string',['limit'=>60,'null'=>false,'default'=>'','comment'=>'规则唯一标识'])
            ->addColumn('title','string',['limit'=>20,'null'=>false,'default'=>'','comment'=>'规则中文名称'])
            ->addColumn('status','integer',['limit'=>MysqlAdapter::INT_TINY,'null'=>false,'default'=>1,'comment'=>'状态：为1正常，为0禁用'])
            ->addColumn('condition','string',['limit'=>128,'null'=>false,'default'=>'','comment'=>'规则表达式，为空表示存在就验证，不为空表示按照条件验证'])
            ->addIndex('name',['unique'=>true])
            ->setPrimaryKey('id')
            ->addIndex('id')
            ->create();
    }
}


