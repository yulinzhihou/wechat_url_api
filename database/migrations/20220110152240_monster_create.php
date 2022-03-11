<?php

use Phinx\Db\Adapter\MysqlAdapter;
use think\migration\Migrator;
use think\migration\db\Column;

class MonsterCreate extends Migrator
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
        $table = $this->table('monster',['primary key'=>'id','auto_increment'=>true,'engine'=>'myisam','comment'=>'怪物表'])->addIndex('id');
        $table
            ->addColumn('name','string',['limit'=>255,'null'=>false,'default'=>'','comment'=>'名称'])
            ->addColumn('render','integer',['limit'=>MysqlAdapter::INT_TINY,'signed'=>false,'null'=>false,'default'=>1,'comment'=>'怪物性别'])
            ->addColumn('level','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'等级'])
            ->addColumn('base_exp','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'基础经验获得'])
            ->addColumn('friendship_value','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'友好值'])
            ->addColumn('interval_second','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'休闲间隔时间'])
            ->addColumn('base_ai','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'基础AI'])
            ->addColumn('extra_ai','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'扩展AI'])
            ->addColumn('group','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'阵营'])
            ->addColumn('drop_radius','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'掉落分配半径(米)'])
            ->addColumn('drop_max_sets','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'掉落最大有效组'])
            ->addColumn('min_drop_hp','decimal',['precision'=>10,'scale'=>2,'signed'=>false,'null'=>false,'default'=>0.00,'comment'=>'最小伤血百分比'])
            ->addColumn('is_talk','integer',['limit'=>MysqlAdapter::INT_TINY,'signed'=>false,'null'=>false,'default'=>1,'comment'=>'是否可以交互'])
            ->addColumn('is_boss','integer',['limit'=>MysqlAdapter::INT_TINY,'signed'=>false,'null'=>false,'default'=>0,'comment'=>'BOSS标记'])
            ->addColumn('phy_attack','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'物理攻击'])
            ->addColumn('phy_def','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'物理防御'])
            ->addColumn('mag_attack','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'魔法攻击'])
            ->addColumn('mag_def','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'魔法防御'])
            ->addColumn('hp_max_value','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'hp的上限'])
            ->addColumn('mp_max_value','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'mp的上限'])
            ->addColumn('hp_back_value','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'HP回复'])
            ->addColumn('mp_back_value','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'mp回复'])
            ->addColumn('hit','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'命中率'])
            ->addColumn('miss','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'闪避'])
            ->addColumn('critical_att','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'会心攻击'])
            ->addColumn('critical_def','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'会心防御'])
            ->addColumn('move_speed','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'移动速度'])
            ->addColumn('step_speed','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'步行速度'])
            ->addColumn('attach_speed','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'攻击速度'])
            ->addColumn('cold_att','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'冰攻'])
            ->addColumn('cold_def','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'冰抗'])
            ->addColumn('resist_cold_def','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'降低目标冰抵抗'])
            ->addColumn('fire_att','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'火攻'])
            ->addColumn('fire_def','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'火抗'])
            ->addColumn('resist_fire_def','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'降低目标火抵抗'])
            ->addColumn('light_att','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'玄攻'])
            ->addColumn('light_def','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'玄抗'])
            ->addColumn('resist_light_def','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'降低目标玄抵抗'])
            ->addColumn('postion_att','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'毒攻'])
            ->addColumn('postion_def','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'毒抗'])
            ->addColumn('resist_postion_def','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'降低目标毒抵抗'])
            ->addColumn('instant_effect_immune_id','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'瞬时效果免疫ID'])
            ->addColumn('sustain_effect_immune_id','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'持续效果免疫ID'])
            ->addColumn('model_id','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'外型ID'])
            ->addColumn('is_show_header','integer',['limit'=>MysqlAdapter::INT_TINY,'signed'=>true,'null'=>false,'default'=>1,'comment'=>'是否显示头顶信息板'])
            ->addColumn('turn_mode','integer',['limit'=>MysqlAdapter::INT_TINY,'signed'=>true,'null'=>false,'default'=>1,'comment'=>'转向模式'])
            ->addColumn('name_table_height','decimal',['precision'=>10,'scale'=>2,'signed'=>false,'null'=>false,'default'=>0.00,'comment'=>'名字板高度'])
            ->addColumn('select_circle','decimal',['precision'=>10,'scale'=>2,'signed'=>false,'null'=>false,'default'=>0.00,'comment'=>'选中环大小'])
            ->addColumn('shadow_size','decimal',['precision'=>10,'scale'=>2,'signed'=>false,'null'=>false,'default'=>0.00,'comment'=>'阴影大小'])
            ->addColumn('head_icon','string',['limit'=>255,'null'=>false,'default'=>'','comment'=>'人物头像'])
            ->addColumn('attach_action_time','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'攻击动作时间'])
            ->addColumn('attach_cold_time','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'攻击冷却时间'])
            ->addColumn('max_lv','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'最大等级'])
            ->addColumn('max_exp','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'最大经验值'])
            ->addColumn('max_att','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'最大物理攻击'])
            ->addColumn('max_def','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'最大物理防御'])
            ->addColumn('max_mag','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'最大魔法攻击'])
            ->addColumn('max_res','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'最大魔法防御'])
            ->addColumn('max_hp','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'最大血量'])
            ->addColumn('is_in_minimap','integer',['limit'=>MysqlAdapter::INT_TINY,'signed'=>true,'null'=>false,'default'=>1,'comment'=>'是否在小地图显示'])
            ->addColumn('shili_id','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'势力ID'])
            ->addColumn('attach_special_id','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'攻击特性ID'])
            ->addColumn('is_attach_npc','integer',['limit'=>MysqlAdapter::INT_TINY,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'是否攻击NPC'])
            ->addColumn('is_defend','integer',['limit'=>MysqlAdapter::INT_TINY,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'是否播放融合，闪避，搁挡动作'])
            ->addColumn('appearance_type','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>2,'comment'=>'外观类型'])
            ->addColumn('hard_type','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'强度类型'])
            ->addColumn('interactive_type','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'交互方式'])
            ->addColumn('active_time','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'激活时间'])
            ->addColumn('attack_type','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'战斗方式'])
            ->create();
    }
}
