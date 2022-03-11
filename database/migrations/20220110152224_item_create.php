<?php

use think\migration\Migrator;
use think\migration\db\Column;

class ItemCreate extends Migrator
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
        $table = $this->table('item',['primary key'=>'id','auto_increment'=>true,'engine'=>'myisam','comment'=>'物品表'])->addIndex('id');
        $table
            ->addColumn('class','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>3306,'comment'=>'类别'])
            ->addColumn('quality','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'品质'])
            ->addColumn('type','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'类型'])
            ->addColumn('medindex','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'物品索引'])
            ->addColumn('icon','string',['limit'=>255,'null'=>false,'default'=>'','comment'=>'图标资源'])
            ->addColumn('name','string',['limit'=>255,'null'=>false,'default'=>'','comment'=>'物品名称'])
            ->addColumn('desc','text',['comment'=>'物品描述'])
            ->addColumn('level','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'等级'])
            ->addColumn('price','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'价格'])
            ->addColumn('sale_price','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'卖出价格'])
            ->addColumn('rule','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'适应规则'])
            ->addColumn('num','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'叠放数量'])
            ->addColumn('script_id','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'脚本ID'])
            ->addColumn('skill_id','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'技能ID'])
            ->addColumn('is_cost','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'是否消耗'])
            ->addColumn('need_skill','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'需求技能'])
            ->addColumn('need_skill_level','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'需求技能等级'])
            ->addColumn('own_num','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'最大持有量'])
            ->addColumn('obj_type','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'选择对象类型'])
            ->addColumn('type_desc','string',['limit'=>255,'null'=>false,'default'=>'','comment'=>'类型描述'])
            ->addColumn('quality_level','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'档次等级'])
            ->addColumn('recipe_id','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'配方ID'])
            ->addColumn('color','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'颜色'])
            ->addColumn('subclass','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'subclass'])
            ->addColumn('is_boardcast','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'是否广播'])
            ->create();

    }
}
