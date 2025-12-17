<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%hero}}`.
 * 抗战英雄人物表
 */
class m251217_000003_create_hero_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%hero}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull()->comment('英雄姓名'),
            'title' => $this->string(200)->comment('职务/头衔'),
            'image_url' => $this->string(500)->comment('照片URL'),
            'brief' => $this->text()->comment('简介'),
            'deeds' => $this->text()->comment('事迹'),
            'contribution' => $this->text()->comment('贡献'),
            'birth_year' => $this->integer()->comment('出生年份'),
            'death_year' => $this->integer()->comment('牺牲年份'),
            'sort_order' => $this->integer()->defaultValue(0)->comment('排序'),
            'status' => $this->smallInteger()->defaultValue(1)->comment('状态 1启用 0禁用'),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            '{{%idx-hero-status}}',
            '{{%hero}}',
            'status'
        );

        $this->createIndex(
            '{{%idx-hero-sort_order}}',
            '{{%hero}}',
            'sort_order'
        );

        // 插入示例数据
        $this->batchInsert('{{%hero}}', 
            ['name', 'title', 'image_url', 'brief', 'deeds', 'contribution', 'birth_year', 'death_year', 'sort_order', 'status', 'created_at', 'updated_at'],
            [
                ['杨靖宇', '东北抗日联军第一路军总司令', '/img/hero1.jpg', '中国共产党优秀党员，无产阶级革命家，著名抗日英雄', '率部与日寇血战于白山黑水之间，在冰天雪地、弹尽粮绝的情况下，孤身一人与大量敌人周旋战斗几昼夜，直至壮烈牺牲', '组建抗日联军，坚持东北游击战争', 1905, 1940, 1, 1, time(), time()],
                ['赵尚志', '东北抗日联军创建者和领导人', '/img/hero2.jpg', '抗日民族英雄，东北抗联创建人和杰出领导人', '多次重创日伪军，冰趟雪卧，威震敌胆，给日本侵略军以沉重打击', '创建东北抗日游击根据地，发展抗日武装力量', 1908, 1942, 2, 1, time(), time()],
                ['赵一曼', '东北抗日联军第三军二团政治委员', '/img/hero3.jpg', '著名抗日民族女英雄，为国捐躯的革命烈士', '领导游击队多次给日伪军以沉重打击，被捕后受尽酷刑，宁死不屈', '领导游击队战斗，是杰出的女性抗日英雄', 1905, 1936, 3, 1, time(), time()],
                ['张自忠', '第33集团军总司令', '/img/hero4.jpg', '国民革命军上将，抗日名将，民族英雄', '在枣宜会战中殉国，是抗战中牺牲的最高将领', '指挥多次重要战役，身先士卒，壮烈殉国', 1891, 1940, 4, 1, time(), time()],
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%hero}}');
    }
}
