<?php

use yii\db\Migration;

/**
 * 更新刘越帅个人作业的下载链接为本地文件路径
 */
class m251222_100000_update_liuyueshuai_download_urls extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // 更新刘越帅的三个个人作业链接
        $this->update('{{%download_counter}}', 
            ['file_url' => 'local:2313752/作业1(2313752_刘越帅).zip'], 
            ['file_name' => '刘越帅-个人作业1.zip']
        );
        
        $this->update('{{%download_counter}}', 
            ['file_url' => 'local:2313752/作业2(2313752_刘越帅).zip'], 
            ['file_name' => '刘越帅-个人作业2.zip']
        );
        
        $this->update('{{%download_counter}}', 
            ['file_url' => 'local:2313752/作业3(2313752_刘越帅).zip'], 
            ['file_name' => '刘越帅-个人作业3.zip']
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
            ['file_name' => '刘越帅-个人作业1.zip']
        );
        
        $this->update('{{%download_counter}}', 
            ['file_url' => 'https://www.researching.cn/ArticlePdf/m00051/2018/33/5/2018-05-0055.pdf'], 
            ['file_name' => '刘越帅-个人作业2.zip']
        );
        
        $this->update('{{%download_counter}}', 
            ['file_url' => 'https://www.researching.cn/ArticlePdf/m00051/2018/33/5/2018-05-0055.pdf'], 
            ['file_name' => '刘越帅-个人作业3.zip']
        );

        return true;
    }
}
