<?php

use think\migration\Migrator;
use think\migration\db\Column;

class AppCreate extends Migrator
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
        $table = $this->table('app',['engine'=>'innodb','charset'=>'utf8mb4','auto_increment'=>true,'primary_key'=>'id','comment'=>'应用表'])->addIndex('id');
        $table
            ->addColumn('app_code','string',['limit'=>128,'null'=>false,'default'=>'','comment'=>'应用编号'])
            ->addColumn('app_name','string',['limit'=>128,'null'=>false,'default'=>'','comment'=>'应用名称'])
            ->addColumn('app_desc','string',['limit'=>128,'null'=>false,'default'=>'','comment'=>'应用描述'])
            ->addColumn('app_id','string',['limit'=>128,'null'=>false,'default'=>'','comment'=>'应用标识ID'])
            ->addColumn('app_secret','string',['limit'=>128,'null'=>false,'default'=>'','comment'=>'应用密钥'])
            ->addColumn('safety_domain','json',['null'=>true,'default'=>null,'comment'=>'授权域名'])
            ->addColumn('public_ssl','text',['null'=>true,'default'=>null,'comment'=>'公钥'])
            ->addColumn('private_ssl','text',['null'=>true,'default'=>null,'comment'=>'私钥'])
            ->addColumn('create_time','integer',['limit'=>10,'null'=>true,'default'=>null,'comment'=>'创建时间'])
            ->addColumn('update_time','integer',['limit'=>10,'null'=>true,'default'=>null,'comment'=>'更新时间'])
            ->addIndex('app_id')
            ->addIndex('app_secret')
            ->addIndex('app_code')
            ->create();
    }
}
