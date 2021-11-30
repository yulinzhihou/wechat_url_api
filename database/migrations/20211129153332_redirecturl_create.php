<?php

use Phinx\Db\Adapter\MysqlAdapter;
use think\migration\Migrator;
use think\migration\db\Column;

class RedirecturlCreate extends Migrator
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
        $table = $this->table('redirect_url',['engine'=>'innodb','charset'=>'utf8mb4','auto_increment'=>true,'comment'=>'直链表']);
        $table
            ->addColumn('admin_id','integer',['limit'=>11,'signed'=>false,'null'=>false,'default'=>0,'comment'=>'管理员ID'])
            ->addColumn('title','string',['limit'=>128,'null'=>false,'default'=>'','comment'=>'标题'])
            ->addColumn('avatar','string',['limit'=>128,'null'=>false,'default'=>'','comment'=>'头像'])
            ->addColumn('nickname','string',['limit'=>128,'null'=>false,'default'=>'','comment'=>'昵称'])
            ->addColumn('user_brief','string',['limit'=>255,'null'=>false,'default'=>'','comment'=>'个性签名'])
            ->addColumn('qrcode_url','string',['limit'=>128,'null'=>false,'default'=>'','comment'=>'二维码'])
            ->addColumn('qrcode_title','string',['limit'=>128,'null'=>false,'default'=>'','comment'=>'二维码标题'])
            ->addColumn('qrcode_desc','string',['limit'=>128,'null'=>false,'default'=>'','comment'=>'二维码描述'])
            ->addColumn('qrcode_content','text',['null'=>true,'default'=>null,'comment'=>'内容'])
            ->addColumn('contact','string',['limit'=>128,'null'=>false,'default'=>'','comment'=>'联系方式'])
            ->addColumn('contact_title','string',['limit'=>255,'null'=>false,'default'=>'','comment'=>'联系方式描述'])
            ->addColumn('status','integer',['limit'=>MysqlAdapter::INT_TINY,'null'=>false,'default'=>0,'comment'=>'状态:0=不显示,1=显示'])
            ->addColumn('qrcode_status','integer',['limit'=>MysqlAdapter::INT_TINY,'null'=>false,'default'=>0,'comment'=>'二维码状态:0=不显示,1=显示'])
            ->addColumn('contact_status','integer',['limit'=>MysqlAdapter::INT_TINY,'null'=>false,'default'=>0,'comment'=>'联系方式状态:0=不显示,1=显示'])
            ->addColumn('show_num','integer',['limit'=>11,'signed'=>false,'null'=>false,'default'=>0,'comment'=>'展示次数'])
            ->addColumn('short_link','string',['limit'=>255,'null'=>false,'default'=>'','comment'=>'短链地址'])
            ->addColumn('click_num','integer',['limit'=>11,'signed'=>false,'null'=>false,'default'=>0,'comment'=>'点击次数'])
            ->addColumn('create_time','integer',['limit'=>11,'signed'=>false,'null'=>false,'default'=>0,'comment'=>'创建时间'])
            ->addColumn('update_time','integer',['limit'=>11,'signed'=>false,'null'=>false,'default'=>0,'comment'=>'更新时间'])
            ->setPrimaryKey('id')
            ->addIndex('id')
            ->create();
    }
}
