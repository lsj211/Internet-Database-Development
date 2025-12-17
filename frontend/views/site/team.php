<?php

/**
 * Team: DBIS, NKU
 * Coding by chengna 2311828
 * This file is used to display the team introduction page.
 */

use yii\helpers\Html;
use yii\helpers\Url;
$this->title = '团队介绍';
?>

<div class="container-fluid py-4">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= Html::encode($this->title) ?></h1>
    </div>

    <!-- 统计数据圆圈 -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                团队成员</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $stats['totalMembers'] ?> 人</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                总下载次数</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $stats['totalDownloads'] ?> 次</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-download fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                网站访问</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $stats['totalVisits'] ?> 次</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-eye fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                留言总数</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $stats['totalComments'] ?> 条</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">团队概况</h6>
                </div>
                <div class="card-body">
                    <p>抗战纪念队成立于2025年，是由多位热爱历史、致力于传承抗日战争精神的大学生在互联网数据库开发课上组成的团队。团队成员来自不同专业，包括计算机、信息安全等专业，通过跨学科合作，共同完成这个意义非凡的项目。</p>
                    <p><strong>团队使命：</strong>铭记历史，缅怀先烈，教育后人，让更多人了解抗日战争的伟大历程和英雄事迹。</p>
                    <p><strong>团队目标：</strong>通过现代信息技术手段，打造一个全面、准确、生动的抗日战争数字纪念馆，为爱国主义教育提供优质资源。</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">团队成员</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>姓名</th>
                                    <th>学号</th>
                                    <th>专业</th>
                                    <th>分工</th>
                                    <th>个人简介</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $members = [
                                    ['name' => '刘越帅', 'student_id' => '2313752', 'major' => '信息安全', 'role' => '队长，统筹+部分后端', 'bio' => '负责项目整体规划与协调，使用 Yii2 框架编写 Controller 层文件，处理后台用户交互逻辑。'],
                                    ['name' => '杨竣羽', 'student_id' => '2313043', 'major' => '信息安全', 'role' => '前端+动态图形', 'bio' => '负责网站前端设计与实现，使用 HTML5、CSS3 和 JavaScript 开发响应式页面和动态图形展示模块。'],
                                    ['name' => '程娜', 'student_id' => '2311828', 'major' => '计算机科学与技术', 'role' => '数据库设计与管理', 'bio' => '擅长数据库设计与优化，负责项目的数据库架构设计与维护。'],
                                    ['name' => '罗仕杰', 'student_id' => '2313965', 'major' => '计算机科学与技术', 'role' => '文档撰写与测试', 'bio' => '细心严谨，负责项目文档编写和功能测试，确保项目质量。'],
                                ];
                                foreach ($members as $member):
                                    // 尝试根据学号找到对应用户
                                    $user = \common\models\User::find()->where(['student_id' => $member['student_id']])->one();
                                ?>
                                <tr>
                                    <td><?= Html::encode($member['name']) ?></td>
                                    <td><?= Html::encode($member['student_id']) ?></td>
                                    <td><?= Html::encode($member['major']) ?></td>
                                    <td><?= Html::encode($member['role']) ?></td>
                                    <td><?= Html::encode($member['bio']) ?></td>
                                    <td>
                                        <?php if ($user): ?>
                                            <a href="<?= Url::to(['/site/profile', 'id' => $user->id]) ?>" class="btn btn-sm btn-primary">
                                                <i class="fas fa-user"></i> 个人主页
                                            </a>
                                        <?php else: ?>
                                            <span class="text-muted">暂无</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
