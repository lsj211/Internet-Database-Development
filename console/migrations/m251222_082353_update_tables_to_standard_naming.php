<?php

use yii\db\Migration;

/**
 * 规范化数据库表结构
 * 1. 添加表注释 (COMMENT)
 * 2. 为page_visit表添加status字段
 * 3. 为message表添加status字段和表注释
 */
class m251222_082353_update_tables_to_standard_naming extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // 为 page_visit 表添加 status 字段
        $this->addColumn('{{%page_visit}}', 'status', $this->smallInteger()->defaultValue(1)->notNull()->comment('状态 1启用 0禁用')->after('visit_count'));
        
        // 为 page_visit 表添加 created_at 字段
        $this->addColumn('{{%page_visit}}', 'created_at', $this->integer()->notNull()->defaultValue(0)->comment('创建时间')->after('status'));
        
        // 为 message 表添加 status 字段
        $this->addColumn('{{%message}}', 'status', $this->smallInteger()->defaultValue(1)->notNull()->comment('状态 1正常 0删除')->after('content'));
        
        // 添加表注释 (MySQL)
        $this->execute("ALTER TABLE {{%page_visit}} COMMENT='统计_页面访问统计表'");
        $this->execute("ALTER TABLE {{%message}} COMMENT='互动_留言消息表'");
        $this->execute("ALTER TABLE {{%hero}} COMMENT='内容_抗战英雄表'");
        $this->execute("ALTER TABLE {{%historical_material}} COMMENT='内容_历史资料表'");
        $this->execute("ALTER TABLE {{%flower_offering}} COMMENT='互动_献花记录表'");
        $this->execute("ALTER TABLE {{%download_counter}} COMMENT='统计_下载计数表'");
        $this->execute("ALTER TABLE {{%profile_comment}} COMMENT='互动_个人主页评论表'");
        $this->execute("ALTER TABLE {{%user}} COMMENT='核心_用户表'");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%page_visit}}', 'status');
        $this->dropColumn('{{%page_visit}}', 'created_at');
        $this->dropColumn('{{%message}}', 'status');
        
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m251222_082353_update_tables_to_standard_naming cannot be reverted.\n";

        return false;
    }
    */
}
