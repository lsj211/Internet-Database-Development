<?php

use yii\db\Migration;

/**
 * 更新profile_comment表的外键，从user表改为member表
 */
class m251223_055025_update_profile_comment_foreign_keys extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // 先清空profile_comment表的数据（因为外键约束会改变）
        $this->delete('{{%profile_comment}}');
        
        // 添加新的外键，引用member表
        $this->addForeignKey(
            'fk-profile_comment-profile_user_id',
            '{{%profile_comment}}',
            'profile_user_id',
            '{{%member}}',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-profile_comment-comment_user_id',
            '{{%profile_comment}}',
            'comment_user_id',
            '{{%member}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // 删除member表的外键
        $this->dropForeignKey('fk-profile_comment-comment_user_id', '{{%profile_comment}}');
        $this->dropForeignKey('fk-profile_comment-profile_user_id', '{{%profile_comment}}');

        // 恢复user表的外键
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
}
