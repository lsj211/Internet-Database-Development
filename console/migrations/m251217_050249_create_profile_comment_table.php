<?php

use yii\db\Migration;

/**
 * 创建个人主页评论表
 */
class m251217_050249_create_profile_comment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%profile_comment}}', [
            'id' => $this->primaryKey(),
            'profile_user_id' => $this->integer()->notNull()->comment('被评论的用户ID'),
            'comment_user_id' => $this->integer()->notNull()->comment('评论者ID'),
            'parent_id' => $this->integer()->defaultValue(null)->comment('父评论ID（用于回复）'),
            'content' => $this->text()->notNull()->comment('评论内容'),
            'status' => $this->smallInteger()->defaultValue(1)->comment('状态 1正常 0删除'),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        // 创建索引
        $this->createIndex('idx-profile_comment-profile_user_id', '{{%profile_comment}}', 'profile_user_id');
        $this->createIndex('idx-profile_comment-comment_user_id', '{{%profile_comment}}', 'comment_user_id');
        $this->createIndex('idx-profile_comment-parent_id', '{{%profile_comment}}', 'parent_id');

        // 添加外键
        $this->addForeignKey(
            'fk-profile_comment-profile_user_id',
            '{{%profile_comment}}',
            'profile_user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-profile_comment-comment_user_id',
            '{{%profile_comment}}',
            'comment_user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-profile_comment-comment_user_id', '{{%profile_comment}}');
        $this->dropForeignKey('fk-profile_comment-profile_user_id', '{{%profile_comment}}');
        $this->dropTable('{{%profile_comment}}');
    }
}
