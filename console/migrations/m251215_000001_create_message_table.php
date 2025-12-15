<?php
use yii\db\Migration;

/**
 * Team: DBIS, NKU
 * Coding by chengna 2311828
 * This file is used to create the message table.
 */
class m251215_000001_create_message_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%message}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'content' => $this->text()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $this->createIndex('{{%idx-message-user_id}}', '{{%message}}', 'user_id');
        $this->createIndex('{{%idx-message-created_at}}', '{{%message}}', 'created_at');

        $this->addForeignKey(
            '{{%fk-message-user_id}}',
            '{{%message}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('{{%fk-message-user_id}}', '{{%message}}');
        $this->dropIndex('{{%idx-message-user_id}}', '{{%message}}');
        $this->dropIndex('{{%idx-message-created_at}}', '{{%message}}');
        $this->dropTable('{{%message}}');
    }
}
