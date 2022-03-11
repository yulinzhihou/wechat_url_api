<?php

use think\migration\Migrator;
use think\migration\db\Column;

class PetCreate extends Migrator
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
        $table = $this->table('pet',['primary key'=>'id','auto_increment'=>true,'engine'=>'myisam','comment'=>'宠物表'])->addIndex('id');
        $table
            ->addColumn('name','string',['limit'=>255,'null'=>false,'default'=>'','comment'=>'名称'])
            ->addColumn('class','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'类型'])
            ->addColumn('catch_level','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'可携带等级'])
            ->addColumn('group','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'阵营'])
            ->addColumn('is_varition','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'是否变异'])
            ->addColumn('is_baby','string',['limit'=>255,'null'=>false,'default'=>'','comment'=>'是否宝宝'])
            ->addColumn('food_type','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'食物类'])
            ->addColumn('skill_study','string',['limit'=>255,'null'=>false,'default'=>'','comment'=>'所能学的技能数'])
            ->addColumn('positive_skill_one','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'主动技能1'])
            ->addColumn('positive_skill_one_percent','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'主动技能1生成几率（1/100w）'])
            ->addColumn('positive_skill_two','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'主动技能2'])
            ->addColumn('positive_skill_two_percent','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'主动技能2生成几率（1/100w）'])
            ->addColumn('negative_skill_one','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'被动技能1'])
            ->addColumn('negative_skill_one_percent','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'被动技能1生成几率（1/100W）'])
            ->addColumn('negative_skill_two','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'被动技能2'])
            ->addColumn('negative_skill_two_percent','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'被动技能2生成几率（1/100W）'])
            ->addColumn('negative_skill_three','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'被动技能3'])
            ->addColumn('negative_skill_three_percent','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'被动技能3生成几率（1/100W）'])
            ->addColumn('negative_skill_four','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'被动技能4'])
            ->addColumn('negative_skill_four_percent','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'被动技能4生成几率（1/100W）'])
            ->addColumn('negative_skill_five','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'被动技能5'])
            ->addColumn('negative_skill_five_percent','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'被动技能5生成几率（1/100W）'])
            ->addColumn('negative_skill_six','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'被动技能6'])
            ->addColumn('negative_skill_six_percent','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'被动技能6生成几率（1/100W）'])
            ->addColumn('negative_skill_seven','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'被动技能7'])
            ->addColumn('negative_skill_seven_percent','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'被动技能7生成几率（1/100W）'])
            ->addColumn('negative_skill_eight','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'被动技能8'])
            ->addColumn('negative_skill_eight_percent','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'被动技能8生成几率（1/100W）'])
            ->addColumn('negative_skill_nine','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'被动技能9'])
            ->addColumn('negative_skill_nine_percent','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'被动技能9生成几率（1/100W）'])
            ->addColumn('negative_skill_ten','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'被动技能10'])
            ->addColumn('negative_skill_ten_percent','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'被动技能10生成几率（1/100W）'])
            ->addColumn('basic_hp','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'标准寿命'])
            ->addColumn('basic_str','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'标准力量资质'])
            ->addColumn('basic_con','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'标准体质资质'])
            ->addColumn('basic_spr','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'标准灵气资质'])
            ->addColumn('basic_dex','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'标准身法资质'])
            ->addColumn('basic_com','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'标准定力资质'])
            ->addColumn('grow_rate_one','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'成长率1'])
            ->addColumn('grow_rate_two','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'成长率2'])
            ->addColumn('grow_rate_three','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'成长率3'])
            ->addColumn('grow_rate_four','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'成长率4'])
            ->addColumn('grow_rate_five','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'成长率5'])
            ->addColumn('timid','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'胆小(1/1000)'])
            ->addColumn('cautious','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'谨慎(1/1000)'])
            ->addColumn('loyal','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'忠诚(1/1000)'])
            ->addColumn('shrewd','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'精明(1/1000)'])
            ->addColumn('bravery','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'勇猛(1/1000)'])
            ->addColumn('breeding_time','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'繁殖时间（毫秒）'])
            ->addColumn('same_type','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'同类参考珍兽类型'])
            ->addColumn('extra_one','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'额外1'])
            ->addColumn('extra_two','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'额外2'])
            ->create();
    }
}
