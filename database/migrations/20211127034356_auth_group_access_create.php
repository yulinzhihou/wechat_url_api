<?php

use Phinx\Db\Adapter\MysqlAdapter;
use think\migration\Migrator;
use think\migration\db\Column;

class AuthGroupAccessCreate extends Migrator
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
        $table = $this->table('auth_group_access',['engine'=>'innodb','charset'=>'utf8mb4','auto_increment'=>true,'comment'=>'用户组明细表']);
        $table
            ->addColumn('admin_id','integer',['limit'=>11,'signed'=>false,'null'=>false,'default'=>0,'comment'=>'用户id'])
            ->addColumn('auth_group_id','integer',['limit'=>11,'signed'=>false,'null'=>false,'default'=>0,'comment'=>'用户组id'])
            ->addIndex('admin_id')
            ->addIndex('auth_group_id')
            ->setPrimaryKey('id')
            ->addIndex('id')
            ->create();
    }
}
