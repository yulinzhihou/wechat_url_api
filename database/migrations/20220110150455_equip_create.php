<?php

use think\migration\Migrator;
use think\migration\db\Column;

class EquipCreate extends Migrator
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
        $table = $this->table('equip',['primary key'=>'id','auto_increment'=>true,'engine'=>'myisam','comment'=>'装备表'])->addIndex('id');
        $table
            ->addColumn('class','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'基本类型'])
            ->addColumn('quality','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'品质'])
            ->addColumn('type','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'类别'])
            ->addColumn('index','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'物品号'])
            ->addColumn('equip_point','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'装备点'])
            ->addColumn('visual','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'外形'])
            ->addColumn('rule','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'适应规则'])
            ->addColumn('suit_id','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'套装编号'])
            ->addColumn('suit_value','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'套装效果值'])
            ->addColumn('name','string',['limit'=>255,'null'=>false,'default'=>'','comment'=>'名称'])
            ->addColumn('lv','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'等级'])
            ->addColumn('menpai','string',['limit'=>255,'null'=>false,'default'=>'','comment'=>'门派需求'])
            ->addColumn('desc','text',['comment'=>'说明'])
            ->addColumn('price','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'基本价格'])
            ->addColumn('sale_price','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'出售价格'])
            ->addColumn('max_value','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'耐久值'])
            ->addColumn('fix_fail_value','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'修理失败上限'])
            ->addColumn('max_gem','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'镶嵌宝石上限'])
            ->addColumn('skill_id','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'技能ID'])
            ->addColumn('script_id','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'脚本ID'])
            ->addColumn('icon','string',['limit'=>255,'signed'=>true,'default'=>'','comment'=>'图标'])
            ->addColumn('desc_type','string',['limit'=>255,'null'=>false,'default'=>'','comment'=>'类型描述'])
            ->addColumn('piao_id','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'飘带ID'])
            ->addColumn('is_zz','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'是否有资质'])
            ->addColumn('is_pz','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'是否受品质影响'])
            ->addColumn('basic_phy_attack','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'基础外攻'])
            ->addColumn('basic_mag_attack','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'基础内攻'])
            ->addColumn('basic_phy_def','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'基础外攻防御'])
            ->addColumn('basic_mag_def','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'基础内攻防御'])
            ->addColumn('basic_hit','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'基础命中'])
            ->addColumn('basic_miss','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'基础闪避'])
            ->addColumn('hp_max_value','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'增加HP的上限'])
            ->addColumn('hp_max_percent','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'百分比增加HP的上限'])
            ->addColumn('hp_back_value','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'加快HP的回复速度'])
            ->addColumn('mp_max_value','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'增加MP的上限'])
            ->addColumn('mp_max_percent','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'百分比增加MP的上限'])
            ->addColumn('mp_back_value','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'加快MP的回复速度'])
            ->addColumn('cold_att','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'冰攻'])
            ->addColumn('cold_def','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'冰抗'])
            ->addColumn('cold_keep_time','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'减少冰冻迟缓时间'])
            ->addColumn('fire_att','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'火攻'])
            ->addColumn('fire_def','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'火抗'])
            ->addColumn('fire_keep_time','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'减少火烧持续时间'])
            ->addColumn('light_att','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'玄攻'])
            ->addColumn('light_def','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'玄抗'])
            ->addColumn('light_keep_time','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'减少玄击眩晕时间'])
            ->addColumn('postion_att','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'毒攻'])
            ->addColumn('postion_def','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'毒抗'])
            ->addColumn('postion_keep_time','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'减少中毒时间'])
            ->addColumn('def_all_percent','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'按百分比抵消所有属性攻击'])
            ->addColumn('phy_attack','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'外攻攻击'])
            ->addColumn('phy_attack_percent','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'按百分比增加外攻攻击'])
            ->addColumn('add_phy_attack_percent','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'对装备基础外攻攻击百分比加成'])
            ->addColumn('phy_def','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'外攻防御'])
            ->addColumn('phy_def_percent','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'按百分比增加外攻防御'])
            ->addColumn('add_phy_def_percent','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'对装备基础外攻防御百分比加成'])
            ->addColumn('miss_phy_def_percent','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'按百分比抵消外攻伤害'])
            ->addColumn('mag_attack','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'内攻攻击'])
            ->addColumn('mag_attack_percent','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'按百分比增加内攻攻击'])
            ->addColumn('add_mag_attack_percent','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'对装备基础内攻攻击百分比加成'])
            ->addColumn('mag_def','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'内攻防御'])
            ->addColumn('mag_def_percent','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'按百分比增加内攻防御'])
            ->addColumn('add_mag_def_percent','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'对装备基础内攻防御百分比加成'])
            ->addColumn('miss_mag_def_percent','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'按百分比抵消内攻伤害'])
            ->addColumn('attach_speed','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'攻击速度(两次攻击间隔时间)'])
            ->addColumn('mag_cold_time','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'内攻冷却速度'])
            ->addColumn('hit','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'命中'])
            ->addColumn('miss','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'闪避'])
            ->addColumn('critical_att','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'会心'])
            ->addColumn('ignore_percent','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'无视对方防御比率'])
            ->addColumn('move_percent','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'移动速度百分比'])
            ->addColumn('attack_back','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'伤害反射'])
            ->addColumn('attach_cost','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'伤害由内力抵消'])
            ->addColumn('str','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'力量'])
            ->addColumn('spr','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'灵气'])
            ->addColumn('con','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'体力'])
            ->addColumn('com','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'定力'])
            ->addColumn('dex','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'身法'])
            ->addColumn('critical_def','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'会心防御'])
            ->addColumn('qian_neng','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'增加所有的人物一级属性'])
            ->addColumn('hp_sto','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'生命偷取'])
            ->addColumn('mp_sto','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'内力偷取'])
            ->addColumn('add_skill_lv','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'增加某个技能等级'])
            ->addColumn('add_all_skill_lv','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'增加所有技能等级'])
            ->addColumn('spe_skill_rate','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'特殊技能发动概率'])
            ->addColumn('resist_cold_def','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'降低目标冰抵抗'])
            ->addColumn('resist_fire_def','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'降低目标火抵抗'])
            ->addColumn('resist_light_def','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'降低目标玄抵抗'])
            ->addColumn('resist_postion_def','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'降低目标毒抵抗'])
            ->addColumn('quality_rule','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'品质规则'])
            ->addColumn('begin_attr','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'起始数值段'])
            ->addColumn('attr_min','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'属性条数min'])
            ->addColumn('attr_max','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'属性条数max'])
            ->addColumn('zz_min','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'资质min'])
            ->addColumn('zz_max','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'资质max'])
            ->addColumn('level_up_id','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'升级后变成资源id'])
            ->addColumn('bag','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'行囊'])
            ->addColumn('box','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'格箱'])
            ->addColumn('is_boradcast','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'是否广播'])
            ->addColumn('float_space','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'浮动空间'])
            ->addColumn('quality_level','integer',['limit'=>10,'signed'=>true,'null'=>false,'default'=>0,'comment'=>'品阶'])
            ->create();
    }
}
