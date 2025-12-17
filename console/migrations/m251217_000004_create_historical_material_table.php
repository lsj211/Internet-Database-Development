<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%historical_material}}`.
 * 抗战史料表
 */
class m251217_000004_create_historical_material_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%historical_material}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(200)->notNull()->comment('标题'),
            'category' => $this->string(50)->comment('分类：战役/宣言/文献等'),
            'image_url' => $this->string(500)->comment('图片URL'),
            'summary' => $this->text()->comment('摘要'),
            'content' => $this->text()->comment('详细内容'),
            'event_date' => $this->date()->comment('事件日期'),
            'source' => $this->string(200)->comment('来源'),
            'sort_order' => $this->integer()->defaultValue(0)->comment('排序'),
            'status' => $this->smallInteger()->defaultValue(1)->comment('状态 1启用 0禁用'),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            '{{%idx-historical_material-status}}',
            '{{%historical_material}}',
            'status'
        );

        $this->createIndex(
            '{{%idx-historical_material-category}}',
            '{{%historical_material}}',
            'category'
        );

        $this->createIndex(
            '{{%idx-historical_material-sort_order}}',
            '{{%historical_material}}',
            'sort_order'
        );

        // 插入示例数据
        $this->batchInsert('{{%historical_material}}', 
            ['title', 'category', 'image_url', 'summary', 'content', 'event_date', 'source', 'sort_order', 'status', 'created_at', 'updated_at'],
            [
                ['抗日救国十大纲领', '宣言', '/img/document1.jpg', '1937年，中国共产党发表抗日救国十大纲领，号召全国人民团结抗战', '为了动员全国人民参加抗战，争取抗战的胜利，中国共产党提出了全面抗战路线和持久战的战略总方针，制定了一套完整的抗战政策和策略', '1937-08-25', '中共中央', 1, 1, time(), time()],
                ['台儿庄大捷', '战役', '/img/document2.jpg', '1938年，中国军队在台儿庄地区重创日军，取得抗战以来第一个大捷', '台儿庄战役是抗日战争时期徐州会战中的一次重要战役。此次战役振奋了全民族的抗战精神，坚定了抗战的信心', '1938-03-16', '国民革命军', 2, 1, time(), time()],
                ['百团大战', '战役', '/img/document3.jpg', '1940年，八路军发动百团大战，沉重打击日军，鼓舞全国军民抗战信心', '百团大战是抗日战争时期，八路军在华北敌后发动的一次大规模进攻和反"扫荡"的战役。这次战役共进行大小战斗1800余次，攻克据点2900余个', '1940-08-20', '八路军总部', 3, 1, time(), time()],
                ['淞沪会战', '战役', '/img/document4.jpg', '1937年淞沪会战，中国军队浴血奋战三个月，粉碎了日军三个月灭亡中国的狂妄计划', '淞沪会战历时三个月，中国军队英勇抗击，虽然最终失利，但粉碎了日本速战速决的战略企图，为后方工业内迁赢得了宝贵时间', '1937-08-13', '国民革命军', 4, 1, time(), time()],
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%historical_material}}');
    }
}
