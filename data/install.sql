-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1
-- 生成日期： 2025-12-22 09:54:38
-- 服务器版本： 10.4.32-MariaDB
-- PHP 版本： 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `yii2advanced`
--

-- --------------------------------------------------------

--
-- 表的结构 `download_counter`
--

CREATE TABLE `download_counter` (
  `id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL COMMENT '文件名',
  `file_type` varchar(50) NOT NULL COMMENT '文件类型：team团队作业/personal个人作业',
  `file_url` varchar(500) DEFAULT NULL COMMENT '文件URL',
  `download_count` int(11) DEFAULT 0 COMMENT '下载次数',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='统计_下载计数表';

--
-- 转存表中的数据 `download_counter`
--

INSERT INTO `download_counter` (`id`, `file_name`, `file_type`, `file_url`, `download_count`, `created_at`, `updated_at`) VALUES
(1, '团队作业-需求文档.pdf', 'team', 'https://www.researching.cn/ArticlePdf/m00051/2018/33/5/2018-05-0055.pdf', 4, 1765941420, 1766391303),
(2, '团队作业-设计文档.pdf', 'team', 'https://www.researching.cn/ArticlePdf/m00051/2018/33/5/2018-05-0055.pdf', 1, 1765941420, 1765945023),
(3, '团队作业-实现文档.pdf', 'team', 'https://www.researching.cn/ArticlePdf/m00051/2018/33/5/2018-05-0055.pdf', 0, 1765941420, 1765941420),
(4, '团队作业-用户手册.pdf', 'team', 'https://www.researching.cn/ArticlePdf/m00051/2018/33/5/2018-05-0055.pdf', 1, 1765941420, 1765944009),
(5, '团队作业-部署文档.pdf', 'team', 'https://www.researching.cn/ArticlePdf/m00051/2018/33/5/2018-05-0055.pdf', 0, 1765941420, 1765941420),
(6, '团队作业-项目展示PPT.pdf', 'team', 'https://www.researching.cn/ArticlePdf/m00051/2018/33/5/2018-05-0055.pdf', 0, 1765941420, 1765941420),
(7, '团队作业-录屏讲解.pdf', 'team', 'https://www.researching.cn/ArticlePdf/m00051/2018/33/5/2018-05-0055.pdf', 1, 1765941420, 1765953209),
(8, '杨竣羽-个人作业1.zip', 'personal', 'https://www.researching.cn/ArticlePdf/m00051/2018/33/5/2018-05-0055.pdf', 0, 1765941420, 1765941420),
(9, '杨竣羽-个人作业2.zip', 'personal', 'https://www.researching.cn/ArticlePdf/m00051/2018/33/5/2018-05-0055.pdf', 0, 1765941420, 1765941420),
(10, '杨竣羽-个人作业3.zip', 'personal', 'https://www.researching.cn/ArticlePdf/m00051/2018/33/5/2018-05-0055.pdf', 0, 1765941420, 1765941420),
(11, '罗仕杰-个人作业1.zip', 'personal', 'https://www.researching.cn/ArticlePdf/m00051/2018/33/5/2018-05-0055.pdf', 0, 1765941420, 1765941420),
(12, '罗仕杰-个人作业2.zip', 'personal', 'https://www.researching.cn/ArticlePdf/m00051/2018/33/5/2018-05-0055.pdf', 0, 1765941420, 1765941420),
(13, '罗仕杰-个人作业3.zip', 'personal', 'https://www.researching.cn/ArticlePdf/m00051/2018/33/5/2018-05-0055.pdf', 0, 1765941420, 1765941420),
(14, '程娜-个人作业1.zip', 'personal', 'local:2311828/作业1(2311828_程娜).zip', 0, 1765941420, 1765941420),
(15, '程娜-个人作业2.zip', 'personal', 'local:2311828/作业2(2311828_程娜).zip', 0, 1765941420, 1765941420),
(16, '程娜-个人作业3.zip', 'personal', 'local:2311828/作业3(2311828_程娜).zip', 0, 1765941420, 1765941420),
(17, '刘越帅-个人作业1.zip', 'personal', 'local:2313752/作业1(2313752_刘越帅).zip', 0, 1765941420, 1765941420),
(18, '刘越帅-个人作业2.zip', 'personal', 'local:2313752/作业2(2313752_刘越帅).zip', 0, 1765941420, 1765941420),
(19, '刘越帅-个人作业3.zip', 'personal', 'local:2313752/作业3(2313752_刘越帅).zip', 0, 1765941420, 1765941420);

-- --------------------------------------------------------

--
-- 表的结构 `flower_offering`
--

CREATE TABLE `flower_offering` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL COMMENT '用户ID，游客为NULL',
  `ip_address` varchar(45) NOT NULL COMMENT 'IP地址',
  `created_at` int(11) NOT NULL COMMENT '献花时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='互动_献花记录表';

--
-- 转存表中的数据 `flower_offering`
--

INSERT INTO `flower_offering` (`id`, `user_id`, `ip_address`, `created_at`) VALUES
(1, 7, '::1', 1765938055);

-- --------------------------------------------------------

--
-- 表的结构 `hero`
--

CREATE TABLE `hero` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL COMMENT '英雄姓名',
  `title` varchar(200) DEFAULT NULL COMMENT '职务/头衔',
  `image_url` varchar(500) DEFAULT NULL COMMENT '照片URL',
  `brief` text DEFAULT NULL COMMENT '简介',
  `deeds` text DEFAULT NULL COMMENT '事迹',
  `contribution` text DEFAULT NULL COMMENT '贡献',
  `birth_year` int(11) DEFAULT NULL COMMENT '出生年份',
  `death_year` int(11) DEFAULT NULL COMMENT '牺牲年份',
  `sort_order` int(11) DEFAULT 0 COMMENT '排序',
  `status` smallint(6) DEFAULT 1 COMMENT '状态 1启用 0禁用',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='内容_抗战英雄表';

--
-- 转存表中的数据 `hero`
--

INSERT INTO `hero` (`id`, `name`, `title`, `image_url`, `brief`, `deeds`, `contribution`, `birth_year`, `death_year`, `sort_order`, `status`, `created_at`, `updated_at`) VALUES
(1, '杨靖宇', '东北抗日联军第一路军总司令', '@web/uploads/heroes/hero_1765941868_6942226c82b44.jpg', '中国共产党优秀党员，无产阶级革命家，著名抗日英雄', '率部与日寇血战于白山黑水之间，在冰天雪地、弹尽粮绝的情况下，孤身一人与大量敌人周旋战斗几昼夜，直至壮烈牺牲', '组建抗日联军，坚持东北游击战争', 1905, 1940, 1, 1, 1765941420, 1765941868),
(2, '赵尚志', '东北抗日联军创建者和领导人', '@web/uploads/heroes/hero_1765941913_69422299a8744.jpg', '抗日民族英雄，东北抗联创建人和杰出领导人', '多次重创日伪军，冰趟雪卧，威震敌胆，给日本侵略军以沉重打击', '创建东北抗日游击根据地，发展抗日武装力量', 1908, 1942, 2, 1, 1765941420, 1765941913),
(3, '赵一曼', '东北抗日联军第三军二团政治委员', '@web/uploads/heroes/hero_1765941959_694222c73a47d.jpg', '著名抗日民族女英雄，为国捐躯的革命烈士', '领导游击队多次给日伪军以沉重打击，被捕后受尽酷刑，宁死不屈', '领导游击队战斗，是杰出的女性抗日英雄', 1905, 1936, 3, 1, 1765941420, 1765941959),
(4, '张自忠', '第33集团军总司令', '@web/uploads/heroes/hero_1765941985_694222e18a1c0.jpg', '国民革命军上将，抗日名将，民族英雄', '在枣宜会战中殉国，是抗战中牺牲的最高将领', '指挥多次重要战役，身先士卒，壮烈殉国', 1891, 1940, 4, 1, 1765941420, 1765941985);

-- --------------------------------------------------------

--
-- 表的结构 `historical_material`
--

CREATE TABLE `historical_material` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL COMMENT '标题',
  `category` varchar(50) DEFAULT NULL COMMENT '分类：战役/宣言/文献等',
  `image_url` varchar(500) DEFAULT NULL COMMENT '图片URL',
  `summary` text DEFAULT NULL COMMENT '摘要',
  `content` text DEFAULT NULL COMMENT '详细内容',
  `event_date` date DEFAULT NULL COMMENT '事件日期',
  `source` varchar(200) DEFAULT NULL COMMENT '来源',
  `sort_order` int(11) DEFAULT 0 COMMENT '排序',
  `status` smallint(6) DEFAULT 1 COMMENT '状态 1启用 0禁用',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='内容_历史资料表';

--
-- 转存表中的数据 `historical_material`
--

INSERT INTO `historical_material` (`id`, `title`, `category`, `image_url`, `summary`, `content`, `event_date`, `source`, `sort_order`, `status`, `created_at`, `updated_at`) VALUES
(1, '抗日救国十大纲领', '宣言', '@web/uploads/materials/material_1765943018_694226eab04f6.jpg', '1937年，中国共产党发表抗日救国十大纲领，号召全国人民团结抗战', '为了动员全国人民参加抗战，争取抗战的胜利，中国共产党提出了全面抗战路线和持久战的战略总方针，制定了一套完整的抗战政策和策略', '1937-08-25', '中共中央', 1, 1, 1765941420, 1765943018),
(2, '台儿庄大捷', '战役', '@web/uploads/materials/material_1765943145_6942276944a1e.jpg', '1938年，中国军队在台儿庄地区重创日军，取得抗战以来第一个大捷', '台儿庄战役是抗日战争时期徐州会战中的一次重要战役。此次战役振奋了全民族的抗战精神，坚定了抗战的信心', '1938-03-16', '国民革命军', 2, 1, 1765941420, 1765943145),
(3, '百团大战', '战役', '@web/uploads/materials/material_1765943201_694227a1075aa.jpg', '1940年，八路军发动百团大战，沉重打击日军，鼓舞全国军民抗战信心', '百团大战是抗日战争时期，八路军在华北敌后发动的一次大规模进攻和反\"扫荡\"的战役。这次战役共进行大小战斗1800余次，攻克据点2900余个', '1940-08-20', '八路军总部', 3, 1, 1765941420, 1765943201),
(4, '淞沪会战', '战役', '@web/uploads/materials/material_1765943235_694227c34dac7.jpg', '1937年淞沪会战，中国军队浴血奋战三个月，粉碎了日军三个月灭亡中国的狂妄计划', '淞沪会战历时三个月，中国军队英勇抗击，虽然最终失利，但粉碎了日本速战速决的战略企图，为后方工业内迁赢得了宝贵时间', '1937-08-13', '国民革命军', 4, 1, 1765941420, 1765943235);

-- --------------------------------------------------------

--
-- 表的结构 `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 1 COMMENT '状态 1正常 0删除',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='互动_留言消息表';

--
-- 转存表中的数据 `message`
--

INSERT INTO `message` (`id`, `user_id`, `content`, `status`, `created_at`, `updated_at`) VALUES
(3, 7, '永远怀念！\r\n', 1, 1765937199, 1765937199);

-- --------------------------------------------------------

--
-- 表的结构 `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- 转存表中的数据 `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1765787768),
('m130524_201442_init', 1765789309),
('m190124_110200_add_verification_token_column_to_user_table', 1765789309),
('m251215_000001_create_message_table', 1765789323),
('m251217_000001_create_flower_offering_table', 1765937777),
('m251217_000002_create_page_visit_table', 1765937777),
('m251217_000003_create_hero_table', 1765941420),
('m251217_000004_create_historical_material_table', 1765941420),
('m251217_000005_create_download_counter_table', 1765941420),
('m251217_050234_extend_user_table_add_profile_fields', 1765947813),
('m251217_050249_create_profile_comment_table', 1765947813),
('m251222_082353_update_tables_to_standard_naming', 1766391925);

-- --------------------------------------------------------

--
-- 表的结构 `page_visit`
--

CREATE TABLE `page_visit` (
  `id` int(11) NOT NULL,
  `page_name` varchar(100) NOT NULL COMMENT '页面名称',
  `visit_count` int(11) NOT NULL DEFAULT 0 COMMENT '访问次数',
  `status` smallint(6) NOT NULL DEFAULT 1 COMMENT '状态 1启用 0禁用',
  `created_at` int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  `updated_at` int(11) NOT NULL COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='统计_页面访问统计表';

--
-- 转存表中的数据 `page_visit`
--

INSERT INTO `page_visit` (`id`, `page_name`, `visit_count`, `status`, `created_at`, `updated_at`) VALUES
(1, 'memorial', 29, 1, 0, 1766392917),
(2, 'index', 8, 1, 1766392278, 1766393670),
(3, 'history', 3, 1, 1766392282, 1766392880),
(4, 'parade', 3, 1, 1766392874, 1766393384);

-- --------------------------------------------------------

--
-- 表的结构 `profile_comment`
--

CREATE TABLE `profile_comment` (
  `id` int(11) NOT NULL,
  `profile_user_id` int(11) NOT NULL COMMENT '被评论的用户ID',
  `comment_user_id` int(11) NOT NULL COMMENT '评论者ID',
  `parent_id` int(11) DEFAULT NULL COMMENT '父评论ID（用于回复）',
  `content` text NOT NULL COMMENT '评论内容',
  `status` smallint(6) DEFAULT 1 COMMENT '状态 1正常 0删除',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='互动_个人主页评论表';

--
-- 转存表中的数据 `profile_comment`
--

INSERT INTO `profile_comment` (`id`, `profile_user_id`, `comment_user_id`, `parent_id`, `content`, `status`, `created_at`, `updated_at`) VALUES
(1, 7, 7, NULL, '哈喽，欢迎来到我的主页', 1, 1765948775, 1765948775),
(2, 7, 7, NULL, '哈喽，欢迎来到我的主页', 1, 1765948775, 1765948775),
(3, 7, 7, 1, '是何意味', 1, 1765948790, 1765948790);

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) DEFAULT NULL,
  `student_id` varchar(20) DEFAULT NULL COMMENT '学号',
  `major` varchar(100) DEFAULT NULL COMMENT '专业',
  `role` varchar(100) DEFAULT NULL COMMENT '团队分工',
  `bio` text DEFAULT NULL COMMENT '个人简介',
  `age` int(11) DEFAULT NULL COMMENT '年龄',
  `signature` varchar(255) DEFAULT NULL COMMENT '个性签名',
  `avatar` varchar(500) DEFAULT NULL COMMENT '头像URL',
  `homework_link` varchar(500) DEFAULT NULL COMMENT '作业链接'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='核心_用户表';

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`, `student_id`, `major`, `role`, `bio`, `age`, `signature`, `avatar`, `homework_link`) VALUES
(7, '程娜', 'HIJj1N0ZFVO5OFx3Ipp5KgaIep6Zpf90', '$2y$13$0Zts/97u97W0jUhsRBCTkOR0iZ6bGTuCwdlRYS/JKgqaInedhUIvy', NULL, '2311828@mail.nankai.edu.cn', 10, 1765797657, 1765950144, 'lAxW0QT3ZOd1gBpsY3VOdPV83mI1gWOT_1765797657', '2311828', '计算机科学与技术', '数据库和后端', '我是来自南开大学的程娜', 21, '这是一条非常有个性的个性签名', '/uploads/avatars/7_1765950144.jpg', 'https://github.com/Dou-Dou-Da-D1'),
(9, '刘越帅', 'gqiMdw0XHWnBxKFjzW1qdfcDB-eyjRxr', '$2y$13$IQAN6JhMRNLho/4n79/CpetCxB8QcGisHZi.c2/jSo4Tw/f/nwMVe', NULL, '2917769103@qq.com', 10, 1766392477, 1766392477, 'dQTZu3Cz8a1k_QFj8n1SldYqXNGj_vEK_1766392477', '2313752', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, '杨竣羽', 'v8H9O3QWq5agBZLy1sY-z7_ycWUbt0iu', '$2y$13$YB9ONFh99aiyMGzMyUe.sudmIRZ5WC1Z2loFOTxYKVU78yZ5RcbdS', NULL, '2939216907@qq.com', 10, 1766392581, 1766392581, '048nZ0kUPunm0RWgIrdAv4cjGb-MYLe-_1766392581', '2313043', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, '罗仕杰', 'A4FeRBLx4ngqwNx8YcQxwkiUoesMfw4M', '$2y$13$xBrO6i6EhnFcg3EpeElm.ePXc.KEhWWUfN6vvRPlihXt.61Td/RW.', NULL, '1515342758@qq.com', 10, 1766393531, 1766393531, 'Y2h10pDl90e2Nn7B9IRyc1CFYDqI1HnU_1766393531', '2313965', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- 转储表的索引
--

--
-- 表的索引 `download_counter`
--
ALTER TABLE `download_counter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-download_counter-file_type` (`file_type`),
  ADD KEY `idx-download_counter-file_name` (`file_name`);

--
-- 表的索引 `flower_offering`
--
ALTER TABLE `flower_offering`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-flower_offering-user_id` (`user_id`),
  ADD KEY `idx-flower_offering-created_at` (`created_at`),
  ADD KEY `idx-flower_offering-ip_address` (`ip_address`);

--
-- 表的索引 `hero`
--
ALTER TABLE `hero`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-hero-status` (`status`),
  ADD KEY `idx-hero-sort_order` (`sort_order`);

--
-- 表的索引 `historical_material`
--
ALTER TABLE `historical_material`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-historical_material-status` (`status`),
  ADD KEY `idx-historical_material-category` (`category`),
  ADD KEY `idx-historical_material-sort_order` (`sort_order`);

--
-- 表的索引 `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-message-user_id` (`user_id`),
  ADD KEY `idx-message-created_at` (`created_at`);

--
-- 表的索引 `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- 表的索引 `page_visit`
--
ALTER TABLE `page_visit`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx-page_visit-page_name` (`page_name`);

--
-- 表的索引 `profile_comment`
--
ALTER TABLE `profile_comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-profile_comment-profile_user_id` (`profile_user_id`),
  ADD KEY `idx-profile_comment-comment_user_id` (`comment_user_id`),
  ADD KEY `idx-profile_comment-parent_id` (`parent_id`);

--
-- 表的索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_user_username` (`username`),
  ADD UNIQUE KEY `idx_user_email` (`email`),
  ADD UNIQUE KEY `idx_user_password_reset_token` (`password_reset_token`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `download_counter`
--
ALTER TABLE `download_counter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- 使用表AUTO_INCREMENT `flower_offering`
--
ALTER TABLE `flower_offering`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `hero`
--
ALTER TABLE `hero`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用表AUTO_INCREMENT `historical_material`
--
ALTER TABLE `historical_material`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用表AUTO_INCREMENT `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用表AUTO_INCREMENT `page_visit`
--
ALTER TABLE `page_visit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用表AUTO_INCREMENT `profile_comment`
--
ALTER TABLE `profile_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- 使用表AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- 限制导出的表
--

--
-- 限制表 `flower_offering`
--
ALTER TABLE `flower_offering`
  ADD CONSTRAINT `fk-flower_offering-user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- 限制表 `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `fk-message-user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `profile_comment`
--
ALTER TABLE `profile_comment`
  ADD CONSTRAINT `fk-profile_comment-comment_user_id` FOREIGN KEY (`comment_user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-profile_comment-profile_user_id` FOREIGN KEY (`profile_user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
