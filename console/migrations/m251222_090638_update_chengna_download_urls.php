<?php

use yii\db\Migration;

/**
 * 更新程娜个人作业的下载链接为本地文件路径
 */
class m251222_090638_update_chengna_download_urls extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // 更新程娜的三个个人作业链接
        $this->update('{{%download_counter}}', 
            ['file_url' => 'local:2311828/作业1(2311828_程娜).zip'], 
            ['file_name' => '程娜-个人作业1.zip']
        );
        
        $this->update('{{%download_counter}}', 
            ['file_url' => 'local:2311828/作业2(2311828_程娜).zip'], 
            ['file_name' => '程娜-个人作业2.zip']
        );
        
        $this->update('{{%download_counter}}', 
            ['file_url' => 'local:2311828/作业3(2311828_程娜).zip'], 
            ['file_name' => '程娜-个人作业3.zip']
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
            ['file_name' => '程娜-个人作业1.zip']
        );
        
        $this->update('{{%download_counter}}', 
            ['file_url' => 'https://www.researching.cn/ArticlePdf/m00051/2018/33/5/2018-05-0055.pdf'], 
            ['file_name' => '程娜-个人作业2.zip']
        );
        
        $this->update('{{%download_counter}}', 
            ['file_url' => 'https://www.researching.cn/ArticlePdf/m00051/2018/33/5/2018-05-0055.pdf'], 
            ['file_name' => '程娜-个人作业3.zip']
        );

        return true;
    }
}
