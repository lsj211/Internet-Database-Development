<?php

/* @var $this yii\web\View */
/* @var $type string */
/* @var $year int */

use yii\helpers\Url;
use yii\helpers\Html;

$this->title = '1949 年空军方阵展示';
$this->params['breadcrumbs'][] = ['label' => '阅兵仪式', 'url' => ['/site/parade']];
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
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
</style>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">1949 年空军方阵</h1>
    <a href="<?= Url::to(['site/formation', 'type' => 'airforce']) ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> 返回空军方阵总览
    </a>
</div>

<div class="row">
    <div class="col-lg-8 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">1949 年空军力量概况</h6>
            </div>
            <div class="card-body">
                <p>1949 年的新中国空军刚刚组建不久，许多飞行员和地勤人员是从原有部队、地方航空学校以及接收的旧政权部队中汇集而来。飞机数量有限，机型复杂，多为螺旋桨式战斗机、教练机和运输机，有的机龄较长、维护条件艰苦，但在新中国成立的历史时刻，它们都肩负起了“守护共和国蓝天”的使命。</p>
                <p>在这一阶段，空军的主要任务包括：支援地面作战、执行侦察和运输任务、配合维护边防和重要目标的空中安全。由于雷达和防空体系尚不完善，很多任务需要飞行员依靠目视导航和经验飞行，飞行环境充满风险。然而，正是在这种条件下，一批批年轻飞行员迅速成长，逐步构成了人民空军的骨干力量。</p>
                <p>在新中国成立阅兵中，空中梯队以简洁而庄重的编队飞行划过天际，机翼在阳光下闪耀着金属光泽。这既是对人民军队空中力量的一次集中展示，也是向国内外发出的一个信号：一个拥有自己空军的新国家，已经昂首屹立在世界东方。</p>
                <p>虽然从今天的视角来看，当时的机型性能有限、数量不多，但对当时的中国人民而言，那一排排划过天安门上空的战机，象征着结束“任人欺凌、空中无防”的屈辱历史，开启了建设现代空军的新征程。</p>
                <p class="text-muted mt-3"></p>
            </div>
        </div>
    </div>

    <div class="col-lg-4 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">1949 年空军装备图</h6>
            </div>
            <div class="card-body text-center">
                <img src="<?= Url::to('@web/img/airforce-1949-1.jpg') ?>" alt="1949 年空军编队示意图" class="img-fluid rounded mb-2" onerror="this.src='<?= Url::to('@web/img/undraw_posting_photo.svg') ?>'">
                <p class="text-muted small mb-0"></p>
            </div>
            <div class="card-body text-center">
                <img src="<?= Url::to('@web/img/airforce-1949-2.jpg') ?>" alt="1949 年空军编队示意图" class="img-fluid rounded mb-2" onerror="this.src='<?= Url::to('@web/img/undraw_posting_photo.svg') ?>'">
                <p class="text-muted small mb-0"></p>
            </div>

        </div>
    </div>
</div>
