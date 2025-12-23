<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%download_counter}}`.
 * 下载统计表
 */
class m251217_000005_create_download_counter_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%download_counter}}', [
            'id' => $this->primaryKey(),
            'file_name' => $this->string(255)->notNull()->comment('文件名'),
            'file_type' => $this->string(50)->notNull()->comment('文件类型：team团队作业/personal个人作业'),
            'file_url' => $this->string(500)->comment('文件URL'),
            'download_count' => $this->integer()->defaultValue(0)->comment('下载次数'),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            '{{%idx-download_counter-file_type}}',
            '{{%download_counter}}',
            'file_type'
        );

        $this->createIndex(
            '{{%idx-download_counter-file_name}}',
            '{{%download_counter}}',
            'file_name'
        );

        // 插入示例数据
        $this->batchInsert('{{%download_counter}}', 
            ['file_name', 'file_type', 'file_url', 'download_count', 'created_at', 'updated_at'],
            [
                ['团队作业-需求文档.pdf', 'team', 'local:团队作业-需求文档.pdf', 0, time(), time()],
                ['团队作业-设计文档.pdf', 'team', 'local:团队作业-设计文档.pdf', 0, time(), time()],
                ['团队作业-实现文档.pdf', 'team', 'local:团队作业-实现文档.pdf', 0, time(), time()],
                ['团队作业-用户手册.pdf', 'team', 'local:团队作业-用户手册.pdf', 0, time(), time()],
                ['团队作业-部署文档.md', 'team', 'local:团队作业-部署文档.md', 0, time(), time()],
                ['团队作业-项目展示PPT.pptx', 'team', 'local:团队作业-项目展示PPT.pptx', 0, time(), time()],
                ['团队作业-录屏讲解.mp4', 'team', 'local:团队作业-录屏讲解.mp4', 0, time(), time()],
                ['杨竣羽-个人作业1.zip', 'personal', 'local:2313043/作业1(2313043_杨竣羽).zip', 0, time(), time()],
                ['杨竣羽-个人作业2.zip', 'personal', 'local:2313043/作业2(2313043_杨竣羽).zip', 0, time(), time()],
                ['杨竣羽-个人作业3.zip', 'personal', 'local:2313043/作业3(2313043_杨竣羽).zip', 0, time(), time()],
                ['罗仕杰-个人作业1.zip', 'personal', 'local:2313965/作业1(2313965_罗仕杰).zip', 0, time(), time()],
                ['罗仕杰-个人作业2.zip', 'personal', 'local:2313965/作业2(2313965_罗仕杰).zip', 0, time(), time()],
                ['罗仕杰-个人作业3.zip', 'personal', 'local:2313965/作业3(2313965_罗仕杰).zip', 0, time(), time()],
                ['程娜-个人作业1.zip', 'personal', 'local:2311828/作业1(2311828_程娜).zip', 0, time(), time()],
                ['程娜-个人作业2.zip', 'personal', 'local:2311828/作业2(2311828_程娜).zip', 0, time(), time()],
                ['程娜-个人作业3.zip', 'personal', 'local:2311828/作业3(2311828_程娜).zip', 0, time(), time()],
                ['刘越帅-个人作业1.zip', 'personal', 'local:2313752/作业1(2313752_刘越帅).zip', 0, time(), time()],
                ['刘越帅-个人作业2.zip', 'personal', 'local:2313752/作业2(2313752_刘越帅).zip', 0, time(), time()],
                ['刘越帅-个人作业3.zip', 'personal', 'local:2313752/作业3(2313752_刘越帅).zip', 0, time(), time()],
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%download_counter}}');
    }
}
