<?php

use yii\db\Migration;

class m251222_120000_create_member_table extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%member}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'verification_token' => $this->string()->defaultValue(null),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'student_id' => $this->string(20)->comment('学号'),
            'major' => $this->string(100)->comment('专业'),
            'role' => $this->string(100)->comment('团队分工'),
            'bio' => $this->text()->comment('个人简介'),
            'age' => $this->integer()->comment('年龄'),
            'signature' => $this->string(255)->comment('个性签名'),
            'avatar' => $this->string(500)->comment('头像URL'),
            'homework_link' => $this->string(500)->comment('作业链接'),
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%member}}');
    }
}
