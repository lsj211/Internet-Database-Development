<?php
use yii\db\Migration;

/**
 * Handles the creation of table `{{%flower_offering}}`.
 */
class m251217_000001_create_flower_offering_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%flower_offering}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->null()->comment('用户ID，游客为NULL'),
            'ip_address' => $this->string(45)->notNull()->comment('IP地址'),
            'created_at' => $this->integer()->notNull()->comment('献花时间'),
        ]);

        $this->createIndex('{{%idx-flower_offering-user_id}}', '{{%flower_offering}}', 'user_id');
        $this->createIndex('{{%idx-flower_offering-created_at}}', '{{%flower_offering}}', 'created_at');
        $this->createIndex('{{%idx-flower_offering-ip_address}}', '{{%flower_offering}}', 'ip_address');

        $this->addForeignKey(
            '{{%fk-flower_offering-user_id}}',
            '{{%flower_offering}}',
            'user_id',
            '{{%user}}',
            'id',
            'SET NULL',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('{{%fk-flower_offering-user_id}}', '{{%flower_offering}}');
        $this->dropIndex('{{%idx-flower_offering-user_id}}', '{{%flower_offering}}');
        $this->dropIndex('{{%idx-flower_offering-created_at}}', '{{%flower_offering}}');
        $this->dropIndex('{{%idx-flower_offering-ip_address}}', '{{%flower_offering}}');
        $this->dropTable('{{%flower_offering}}');
    }
}
