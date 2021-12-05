<?php

use think\migration\Migrator;
use think\migration\db\Column;

class AdminLogCreate extends Migrator
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
        $table = $this->table('log_visit',['engine'=>'MyIsam','auto_increment'=>true,'charset'=>'utf8','primary_key'=>'id','comment'=>'日志记录表'])->addIndex('id');
        $table
            ->addColumn('admin_id','integer',['limit'=>10,'signed'=>false,'default'=>0,'null'=>false,'comment'=>'管理员ID'])
            ->addColumn('admin_name','string',['limit'=>255,'default'=>'','null'=>false,'comment'=>'管理员名称'])
            ->addColumn('method','string',['limit'=>50,'default'=>'get','null'=>false,'comment'=>'请求类型'])
            ->addColumn('log_type','string',['limit'=>50,'default'=>'get','null'=>false,'comment'=>'日志类型'])
            ->addColumn('url','text',['default'=>null,'null'=>true,'comment'=>'请求的URL'])
            ->addColumn('params','text',['default'=>null,'null'=>true,'comment'=>'请求参数'])
            ->addColumn('request','string',['limit'=>50,'default'=>'get','null'=>false,'comment'=>'请求方式'])
            ->addColumn('controller','string',['limit'=>50,'default'=>'','null'=>false,'comment'=>'操作模块'])
            ->addColumn('action','string',['limit'=>50,'default'=>'','null'=>false,'comment'=>'操作方法'])
            ->addColumn('ip','string',['limit'=>15,'default'=>'','null'=>false,'comment'=>'访问IP'])
            ->addColumn('create_time','integer',['limit'=>10,'signed'=>false,'default'=>0,'null'=>false,'comment'=>'创建时间'])
            ->addColumn('update_time','integer',['limit'=>10,'signed'=>false,'default'=>0,'null'=>false,'comment'=>'更新时间'])
            ->addIndex(['method','ip','controller','create_time'])
            ->create();
    }
}
