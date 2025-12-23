<?php

use yii\db\Migration;

/**
 * 更新杨竣羽个人作业的下载链接为本地文件路径
 */
class m251223_074210_update_yangjunyu_download_urls extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // 更新杨竣羽的三个个人作业链接
        $this->update('{{%download_counter}}', 
            ['file_url' => 'local:2313043/作业1(2313043_杨竣羽).zip'], 
            ['file_name' => '杨竣羽-个人作业1.zip']
        );
        
        $this->update('{{%download_counter}}', 
            ['file_url' => 'local:2313043/作业2(2313043_杨竣羽).zip'], 
            ['file_name' => '杨竣羽-个人作业2.zip']
        );
        
        $this->update('{{%download_counter}}', 
            ['file_url' => 'local:2313043/作业3(2313043_杨竣羽).zip'], 
            ['file_name' => '杨竣羽-个人作业3.zip']
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
            ['file_name' => '杨竣羽-个人作业1.zip']
        );
        
        $this->update('{{%download_counter}}', 
            ['file_url' => 'https://www.researching.cn/ArticlePdf/m00051/2018/33/5/2018-05-0055.pdf'], 
            ['file_name' => '杨竣羽-个人作业2.zip']
        );
        
        $this->update('{{%download_counter}}', 
            ['file_url' => 'https://www.researching.cn/ArticlePdf/m00051/2018/33/5/2018-05-0055.pdf'], 
            ['file_name' => '杨竣羽-个人作业3.zip']
        );

        return true;
    }
}
