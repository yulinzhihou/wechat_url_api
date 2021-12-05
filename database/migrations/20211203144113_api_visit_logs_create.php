<?php

use Phinx\Db\Adapter\MysqlAdapter;
use think\migration\Migrator;
use think\migration\db\Column;

class ApiVisitLogsCreate extends Migrator
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
        $table = $this->table('api_visit_logs',['engine'=>'myisam','charset'=>'utf8mb4','auto_increment'=>true,'primary_key'=>'id','comment'=>'接口请求日志'])->addIndex('id');
        $table
            ->addColumn('app_id','string',['limit'=>128,'null'=>false,'default'=>'','comment'=>'应用ID'])
            ->addColumn('method','string',['limit'=>20,'null'=>false,'default'=>'','comment'=>'请求类型'])
            ->addColumn('module','string',['limit'=>128,'null'=>false,'default'=>'','comment'=>'请求模块'])
            ->addColumn('route','string',['limit'=>128,'null'=>false,'default'=>'','comment'=>'路由'])
            ->addColumn('status','string',['limit'=>20,'null'=>false,'default'=>'','comment'=>'状态码'])
            ->addColumn('params','text',['null'=>true,'default'=>null,'comment'=>'请求参数'])
            ->addColumn('refer_url','string',['limit'=>128,'null'=>false,'default'=>'','comment'=>'来源地址'])
            ->addColumn('ip','string',['limit'=>128,'null'=>false,'default'=>'','comment'=>'请求IP'])
            ->addColumn('log_type','integer',['limit'=>MysqlAdapter::INT_TINY,'signed'=>false,'null'=>false,'default'=>0,'comment'=>'日志类型'])
            ->addColumn('waster_time','integer',['limit'=>10,'signed'=>false,'null'=>false,'default'=>0,'comment'=>'接口耗时'])
            ->addColumn('create_time','integer',['limit'=>10,'signed'=>false,'null'=>false,'default'=>0,'comment'=>'创建时间'])
            ->addColumn('update_time','integer',['limit'=>10,'signed'=>false,'null'=>false,'default'=>0,'comment'=>'更新时间'])
            ->addIndex('ip')
            ->addIndex('method')
            ->addIndex('app_id')
            ->create();
    }
}
