<?php
use yii\db\Migration;

/**
 * Handles the creation of table `{{%page_visit}}`.
 */
class m251217_000002_create_page_visit_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%page_visit}}', [
            'id' => $this->primaryKey(),
            'page_name' => $this->string(100)->notNull()->comment('页面名称'),
            'visit_count' => $this->integer()->notNull()->defaultValue(0)->comment('访问次数'),
            'updated_at' => $this->integer()->notNull()->comment('更新时间'),
        ]);

        $this->createIndex('{{%idx-page_visit-page_name}}', '{{%page_visit}}', 'page_name', true);
        
        // 初始化烈士纪念页面访问记录
        $this->insert('{{%page_visit}}', [
            'page_name' => 'memorial',
            'visit_count' => 0,
            'updated_at' => time(),
        ]);
    }

    public function safeDown()
    {
        $this->dropIndex('{{%idx-page_visit-page_name}}', '{{%page_visit}}');
        $this->dropTable('{{%page_visit}}');
    }
}
