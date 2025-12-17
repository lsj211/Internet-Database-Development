<?php

use yii\db\Migration;

class m251217_050234_extend_user_table_add_profile_fields extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'student_id', $this->string(20)->comment('学号'));
        $this->addColumn('{{%user}}', 'major', $this->string(100)->comment('专业'));
        $this->addColumn('{{%user}}', 'role', $this->string(100)->comment('团队分工'));
        $this->addColumn('{{%user}}', 'bio', $this->text()->comment('个人简介'));
        $this->addColumn('{{%user}}', 'age', $this->integer()->comment('年龄'));
        $this->addColumn('{{%user}}', 'signature', $this->string(255)->comment('个性签名'));
        $this->addColumn('{{%user}}', 'avatar', $this->string(500)->comment('头像URL'));
        $this->addColumn('{{%user}}', 'homework_link', $this->string(500)->comment('作业链接'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'homework_link');
        $this->dropColumn('{{%user}}', 'avatar');
        $this->dropColumn('{{%user}}', 'signature');
        $this->dropColumn('{{%user}}', 'age');
        $this->dropColumn('{{%user}}', 'bio');
        $this->dropColumn('{{%user}}', 'role');
        $this->dropColumn('{{%user}}', 'major');
        $this->dropColumn('{{%user}}', 'student_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m251217_050234_extend_user_table_add_profile_fields cannot be reverted.\n";

        return false;
    }
    */
}
