<?php

use yii\db\Migration;

/**
 * 更新罗仕杰个人作业的下载链接为本地文件路径
 */
class m251222_130000_update_luoshi_jie_download_urls extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // 更新罗仕杰的三个个人作业链接
        $this->update('{{%download_counter}}',
            ['file_url' => 'local:2313965/作业1(2313965_罗仕杰).zip'],
            ['file_name' => '罗仕杰-个人作业1.zip']
        );

        $this->update('{{%download_counter}}',
            ['file_url' => 'local:2313965/作业2(2313965_罗仕杰).zip'],
            ['file_name' => '罗仕杰-个人作业2.zip']
        );

        $this->update('{{%download_counter}}',
            ['file_url' => 'local:2313965/作业3(2313965_罗仕杰).zip'],
            ['file_name' => '罗仕杰-个人作业3.zip']
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // 恢复为原来的外部链接
        $this->update('{{%download_counter}}',
            ['file_url' => 'https://www.researching.cn/ArticlePdf/m00051/2018/33/5/2018-05-0055.pdf'],
            ['file_name' => '罗仕杰-个人作业1.zip']
        );

        $this->update('{{%download_counter}}',
            ['file_url' => 'https://www.researching.cn/ArticlePdf/m00051/2018/33/5/2018-05-0055.pdf'],
            ['file_name' => '罗仕杰-个人作业2.zip']
        );

        $this->update('{{%download_counter}}',
            ['file_url' => 'https://www.researching.cn/ArticlePdf/m00051/2018/33/5/2018-05-0055.pdf'],
            ['file_name' => '罗仕杰-个人作业3.zip']
        );

        return true;
    }
}
