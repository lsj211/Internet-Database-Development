<?php

/**
 * Team: DBIS, NKU
 * Coding by chengna 2311828
 * This file is used to display the team's homepage with a background image and various cards for team introduction, statistics, and member profiles.
 */

/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = '团队主页 - 抗战胜利80周年';
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
    /* 抗战主题背景图片 */
    body {
        background-image: url('<?= Url::to('@web/img/china-map-bg.jpg') ?>');
        background-size: cover;
        background-attachment: fixed;
        background-repeat: no-repeat;
    }

    .card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
    }

    .timeline {
        position: relative;
        padding: 20px 0;
    }
    
    .timeline::before {
        content: '';
        position: absolute;
        left: 30px;
        top: 0;
        bottom: 0;
        width: 2px;
        background: var(--primary);
    }
    
    .timeline-item {
        position: relative;
        margin-bottom: 20px;
        padding-left: 60px;
    }
    
    .timeline-marker {
        position: absolute;
        left: 20px;
        top: 0;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        border: 3px solid #fff;
        z-index: 1;
    }
    
    .timeline-content h5 {
        margin-bottom: 5px;
        color: var(--dark);
    }
    
    .timeline-content p {
        margin: 0;
        color: #666;
    }
</style>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">传承红色记忆，致敬抗战先烈</h1>
    <span class="text-muted">
        <i class="fas fa-eye"></i> 首页访问: <strong><?= isset($stats['indexVisits']) ? number_format($stats['indexVisits']) : 0 ?></strong>
    </span>
</div>

<!-- Content Row -->
<div class="row">

    <!-- 团队介绍 Card -->
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">团队介绍</h6>
            </div>
            <div class="card-body">
                <p>抗战纪念队成立于2025年，是一个致力于传承抗日战争历史记忆、弘扬爱国主义精神的学生团队。我们通过网站建设、历史资料整理、线上展览等方式，向广大师生和社会公众展示抗日战争的伟大历程和英雄事迹。</p>
                <p>团队口号：<strong>铭记历史，缅怀先烈，展望未来</strong></p>
                <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 55%;"
                    src="<?= Url::to('@web/img/team.png') ?>" alt="团队合照" onerror="this.src='<?= Url::to('@web/img/undraw_posting_photo.svg') ?>'">
            </div>
        </div>
    </div>

    <!-- 统计数据 Card -->
    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">网站统计</h6>
            </div>
            <div class="card-body">
                <div class="chart-pie pt-4 pb-2">
                    <canvas id="myPieChart"></canvas>
                </div>
                <div class="mt-4 text-center small">
                    <div class="d-flex flex-wrap justify-content-center">
                        <div class="px-3 py-1">
                            <i class="fas fa-circle text-primary"></i> 团队成员: <?= $stats['totalMembers'] ?> 人
                        </div>
                        <div class="px-3 py-1">
                            <i class="fas fa-circle text-warning"></i> 用户人数: <?= $stats['totalUsers'] ?> 人
                        </div>
                        <div class="px-3 py-1">
                            <i class="fas fa-circle text-success"></i> 英雄人物: <?= $stats['totalHeroes'] ?> 位
                        </div>
                        <div class="px-3 py-1">
                            <i class="fas fa-circle text-info"></i> 历史资料: <?= $stats['totalMaterials'] ?> 份
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content Row -->
<div class="row">

    <!-- 团队成员 -->
    <div class="col-lg-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">团队成员</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <img class="card-img-top" src="<?= Url::to('@web/img/member1.jpg') ?>" alt="成员1" onerror="this.src='<?= Url::to('@web/img/undraw_profile_1.svg') ?>'">
                            <div class="card-body">
                                <h5 class="card-title">刘越帅</h5>
                                <p class="card-text">学号：2313752<br>分工：队长，统筹+部分后端<br>具体负责：制定项目进度表，组织团队会议，审核所有交付物；撰写需求、设计、实现、用户手册、部署文档；整合所有文件并按要求提交至指定邮箱。</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <img class="card-img-top" style="height: 65;"src="<?= Url::to('@web/img/member2.jpg') ?>" alt="成员2" onerror="this.src='<?= Url::to('@web/img/undraw_profile_2.svg') ?>'">
                            <div class="card-body">
                                <h5 class="card-title">杨竣羽</h5>
                                <p class="card-text">学号：2313043<br>分工：前端+动态图形<br>具体负责：设计团队主页原型，用 HTML5+CSS3+JavaScript 实现前后台页面布局与响应式适配；集成 JQuery/Ajax 实现留言等异步交互；开发动态图形展示模块（如抗战历史数据可视化）。</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <img class="card-img-top" src="<?= Url::to('@web/img/member3.jpg') ?>" alt="成员3" onerror="this.src='<?= Url::to('@web/img/undraw_profile_3.svg') ?>'">
                            <div class="card-body">
                                <h5 class="card-title">程娜</h5>
                                <p class="card-text">学号：2311828<br>分工：后端+数据库<br>具体负责：设计≥10 张数据库表，绘制 ER 图、编写数据库字典与 SQL 文件（/data/install.sql）；用 Yii2 框架编写Model 层文件，负责数据逻辑处理；配置数据库连接（main-local.php）。</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <img class="card-img-top" src="<?= Url::to('@web/img/member4.jpg') ?>" alt="成员4" onerror="this.src='<?= Url::to('@web/img/undraw_profile_1.svg') ?>'">
                            <div class="card-body">
                                <h5 class="card-title">罗仕杰</h5>
                                <p class="card-text">学号：2313965<br>分工：文档+测试+展示<br>具体负责：简化部署模式,完成功能测试；连接前后端逻辑；制作项目展示 PPT（明确分工与工作量）；录制 5-15 分钟录屏讲解（含部署、网页演示、PPT 讲解）。</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?php
// 将统计数据传递给 JavaScript
$chartData = [
    'totalMembers' => $stats['totalMembers'],
    'totalUsers' => $stats['totalUsers'],
    'totalHeroes' => $stats['totalHeroes'],
    'totalMaterials' => $stats['totalMaterials'],
];

$this->registerJsFile('https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js', ['depends' => [\yii\web\JqueryAsset::class]]);

$js = <<<JS
// 使用后端传递的真实数据
Chart.defaults.font.family = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.color = '#858796';

var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["团队成员", "用户人数", "英雄人物", "历史资料"],
    datasets: [{
      data: [{$chartData['totalMembers']}, {$chartData['totalUsers']}, {$chartData['totalHeroes']}, {$chartData['totalMaterials']}],
      backgroundColor: ['#8B0000', '#FF8C00', '#228B22', '#4169E1'],
      hoverBackgroundColor: ['#A52A2A', '#FFA500', '#32CD32', '#4682B4'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }]
  },
  options: {
    maintainAspectRatio: false,
    plugins: {
      tooltip: {
        backgroundColor: "rgb(255,255,255)",
        bodyColor: "#858796",
        borderColor: '#dddfeb',
        borderWidth: 1,
        padding: 15,
        displayColors: false,
        caretPadding: 10,
        callbacks: {
          label: function(context) {
            var label = context.label || '';
            var value = context.parsed;
            return label + ': ' + value;
          }
        }
      },
      legend: {
        display: false
      }
    },
    cutout: '80%',
  },
});
JS;

$this->registerJs($js, \yii\web\View::POS_READY);
?>
