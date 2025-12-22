<?php

use yii\db\Migration;

/**
 * 插入所有初始数据（从install.sql）
 */
class m251222_093621_insert_all_initial_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // 插入用户数据
        $this->batchInsert('{{%user}}', 
            ['id', 'username', 'auth_key', 'password_hash', 'password_reset_token', 'email', 'status', 'created_at', 'updated_at', 'verification_token', 'student_id', 'major', 'role', 'bio', 'age', 'signature', 'avatar', 'homework_link'],
            [
                [7, '程娜', 'HIJj1N0ZFVO5OFx3Ipp5KgaIep6Zpf90', '$2y$13$0Zts/97u97W0jUhsRBCTkOR0iZ6bGTuCwdlRYS/JKgqaInedhUIvy', null, '2311828@mail.nankai.edu.cn', 10, 1765797657, 1765950144, 'lAxW0QT3ZOd1gBpsY3VOdPV83mI1gWOT_1765797657', '2311828', '计算机科学与技术', '数据库和后端', '我是来自南开大学的程娜', 21, '这是一条非常有个性的个性签名', '/uploads/avatars/7_1765950144.jpg', 'https://github.com/Dou-Dou-Da-D1'],
                [9, '刘越帅', 'gqiMdw0XHWnBxKFjzW1qdfcDB-eyjRxr', '$2y$13$IQAN6JhMRNLho/4n79/CpetCxB8QcGisHZi.c2/jSo4Tw/f/nwMVe', null, '2917769103@qq.com', 10, 1766392477, 1766392477, 'dQTZu3Cz8a1k_QFj8n1SldYqXNGj_vEK_1766392477', '2313752', null, null, null, null, null, null, null],
                [10, '杨竣羽', 'v8H9O3QWq5agBZLy1sY-z7_ycWUbt0iu', '$2y$13$YB9ONFh99aiyMGzMyUe.sudmIRZ5WC1Z2loFOTxYKVU78yZ5RcbdS', null, '2939216907@qq.com', 10, 1766392581, 1766392581, '048nZ0kUPunm0RWgIrdAv4cjGb-MYLe-_1766392581', '2313043', null, null, null, null, null, null, null],
                [11, '罗仕杰', 'A4FeRBLx4ngqwNx8YcQxwkiUoesMfw4M', '$2y$13$xBrO6i6EhnFcg3EpeElm.ePXc.KEhWWUfN6vvRPlihXt.61Td/RW.', null, '1515342758@qq.com', 10, 1766393531, 1766393531, 'Y2h10pDl90e2Nn7B9IRyc1CFYDqI1HnU_1766393531', '2313965', null, null, null, null, null, null, null],
            ]
        );

        // 插入留言数据
        $this->insert('{{%message}}', [
            'id' => 3,
            'user_id' => 7,
            'content' => '永远怀念！',
            'status' => 1,
            'created_at' => 1765937199,
            'updated_at' => 1765937199,
        ]);

        // 插入献花记录
        $this->insert('{{%flower_offering}}', [
            'id' => 1,
            'user_id' => 7,
            'ip_address' => '::1',
            'created_at' => 1765938055,
        ]);

        // 插入页面访问统计（如果不存在才插入）
        $this->execute("INSERT INTO {{%page_visit}} (id, page_name, visit_count, status, created_at, updated_at) VALUES 
            (1, 'memorial', 29, 1, 0, 1766392917),
            (2, 'index', 8, 1, 1766392278, 1766393670),
            (3, 'history', 3, 1, 1766392282, 1766392880),
            (4, 'parade', 3, 1, 1766392874, 1766393384)
            ON DUPLICATE KEY UPDATE visit_count=VALUES(visit_count), updated_at=VALUES(updated_at)");


        // 插入个人主页评论
        $this->batchInsert('{{%profile_comment}}',
            ['id', 'profile_user_id', 'comment_user_id', 'parent_id', 'content', 'status', 'created_at', 'updated_at'],
            [
                [1, 7, 7, null, '哈喽，欢迎来到我的主页', 1, 1765948775, 1765948775],
                [2, 7, 7, null, '哈喽，欢迎来到我的主页', 1, 1765948775, 1765948775],
                [3, 7, 7, 1, '是何意味', 1, 1765948790, 1765948790],
            ]
        );

        // 更新下载记录的下载次数和更新时间
        $this->update('{{%download_counter}}', ['download_count' => 4, 'updated_at' => 1766391303], ['id' => 1]);
        $this->update('{{%download_counter}}', ['download_count' => 1, 'updated_at' => 1765945023], ['id' => 2]);
        $this->update('{{%download_counter}}', ['download_count' => 1, 'updated_at' => 1765944009], ['id' => 4]);
        $this->update('{{%download_counter}}', ['download_count' => 1, 'updated_at' => 1765953209], ['id' => 7]);

        // 更新程娜的个人作业为本地文件
        $this->update('{{%download_counter}}', ['file_url' => 'local:2311828/作业1(2311828_程娜).zip'], ['file_name' => '程娜-个人作业1.zip']);
        $this->update('{{%download_counter}}', ['file_url' => 'local:2311828/作业2(2311828_程娜).zip'], ['file_name' => '程娜-个人作业2.zip']);
        $this->update('{{%download_counter}}', ['file_url' => 'local:2311828/作业3(2311828_程娜).zip'], ['file_name' => '程娜-个人作业3.zip']);

        // 更新刘越帅的个人作业为本地文件
        $this->update('{{%download_counter}}', ['file_url' => 'local:2313752/作业1(2313752_刘越帅).zip'], ['file_name' => '刘越帅-个人作业1.zip']);
        $this->update('{{%download_counter}}', ['file_url' => 'local:2313752/作业2(2313752_刘越帅).zip'], ['file_name' => '刘越帅-个人作业2.zip']);
        $this->update('{{%download_counter}}', ['file_url' => 'local:2313752/作业3(2313752_刘越帅).zip'], ['file_name' => '刘越帅-个人作业3.zip']);

        // 更新英雄图片路径为真实上传的图片
        $this->update('{{%hero}}', ['image_url' => '@web/uploads/heroes/hero_1765941868_6942226c82b44.jpg'], ['id' => 1]);
        $this->update('{{%hero}}', ['image_url' => '@web/uploads/heroes/hero_1765941913_69422299a8744.jpg'], ['id' => 2]);
        $this->update('{{%hero}}', ['image_url' => '@web/uploads/heroes/hero_1765941959_694222c73a47d.jpg'], ['id' => 3]);
        $this->update('{{%hero}}', ['image_url' => '@web/uploads/heroes/hero_1765941985_694222e18a1c0.jpg'], ['id' => 4]);

        // 更新历史资料图片路径为真实上传的图片
        $this->update('{{%historical_material}}', ['image_url' => '@web/uploads/materials/material_1765943018_694226eab04f6.jpg'], ['id' => 1]);
        $this->update('{{%historical_material}}', ['image_url' => '@web/uploads/materials/material_1765943145_6942276944a1e.jpg'], ['id' => 2]);
        $this->update('{{%historical_material}}', ['image_url' => '@web/uploads/materials/material_1765943201_694227a1075aa.jpg'], ['id' => 3]);
        $this->update('{{%historical_material}}', ['image_url' => '@web/uploads/materials/material_1765943235_694227c34dac7.jpg'], ['id' => 4]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('{{%profile_comment}}', ['in', 'id', [1, 2, 3]]);
        $this->delete('{{%page_visit}}', ['in', 'id', [1, 2, 3, 4]]);
        $this->delete('{{%flower_offering}}', ['id' => 1]);
        $this->delete('{{%message}}', ['id' => 3]);
        $this->delete('{{%user}}', ['in', 'id', [7, 9, 10, 11]]);
        
        return true;
    }
}
