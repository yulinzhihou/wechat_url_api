<?php

use Phinx\Db\Adapter\MysqlAdapter;
use think\migration\Migrator;
use think\migration\db\Column;

class AppconfigCreate extends Migrator
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
        $table = $this->table('app_config',['engine'=>'innodb','charset'=>'utf8mb4','auto_increment'=>true,'comment'=>'小程序配置表']);
        $table
            ->addColumn('app_id','string',['limit'=>128,'null'=>false,'default'=>'','comment'=>'小程序APPID'])
            ->addColumn('app_secret','string',['limit'=>128,'null'=>false,'default'=>'','comment'=>'小程序密钥'])
            ->addColumn('logo','string',['limit'=>128,'null'=>false,'default'=>'','comment'=>'小程序logo'])
            ->addColumn('app_name','string',['limit'=>128,'null'=>false,'default'=>'','comment'=>'小程序名称'])
            ->addColumn('token','string',['limit'=>128,'null'=>false,'default'=>'','comment'=>'小程序token'])
            ->addColumn('encoding_key','string',['limit'=>128,'null'=>false,'default'=>'','comment'=>'EncodingAESKey'])
            ->addColumn('encode_type','integer',['limit'=>MysqlAdapter::INT_TINY,'null'=>false,'default'=>0,'comment'=>'加密方式:0=明文模式,1=兼容模式,2=安全模式（推荐）'])
            ->addColumn('api_url','string',['limit'=>128,'null'=>false,'default'=>'','comment'=>'接口地址'])
            ->addColumn('create_time','integer',['limit'=>11,'signed'=>false,'null'=>false,'default'=>0,'comment'=>'创建时间'])
            ->addColumn('update_time','integer',['limit'=>11,'signed'=>false,'null'=>false,'default'=>0,'comment'=>'更新时间'])
            ->setPrimaryKey('id')
            ->addIndex('id')
            ->create();
    }
}
