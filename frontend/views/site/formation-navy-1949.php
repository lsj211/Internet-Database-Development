<?php

/* @var $this yii\web\View */
/* @var $type string */
/* @var $year int */

use yii\helpers\Url;
use yii\helpers\Html;

$this->title = '1949 年海军方阵展示';
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
    <h1 class="h3 mb-0 text-gray-800">1949 年海军方阵</h1>
    <a href="<?= Url::to(['site/formation', 'type' => 'navy']) ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> 返回海军方阵总览
    </a>
</div>

<div class="row">
    <div class="col-lg-8 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">1949 年海军力量概况</h6>
            </div>
            <div class="card-body">
                <p>新中国成立之初，海军力量可以说是“几乎从零起步”。早期的舰艇主要来源于接收改编旧政权的残存舰只、战时缴获的舰船，以及自行改装的小型炮艇和登陆艇。这些舰艇吨位普遍不大、火力有限、技术状况参差不齐，但却承担着守卫漫长海岸线和重要港口的重大责任。</p>
                <p>在组织结构上，当时的海军部队以沿海防御、江河警戒和港口警备为主要任务。许多官兵原本来自陆军或其他兵种，需要在较短时间内重新学习海军专业知识，包括航海、舰炮、防雷、通信等科目。条件虽然艰苦，但大家都怀着同一个目标：让新中国不再在海上受人欺辱。</p>
                <p>1949 年的海军方阵出现在阅兵场上时，更像是一种庄严的宣告——中华民族正在迈出建设现代海军的第一步。方阵中展示的，可能只是少量舰艇模型、海军军官和水兵代表，却承载着“由近海防御走向远海护卫”的长远梦想。</p>
                <p>从历史的角度回望，这一时期的人民海军虽然力量微弱，但正是有了这些“从木船、炮艇起步”的探索，才逐步发展出后来的驱逐舰、护卫舰、潜艇编队，最终形成有能力保护国家海洋权益的现代化海军力量。</p>
                <p class="text-muted mt-3"></p>
            </div>
        </div>
    </div>

    <div class="col-lg-4 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">1949 年海军装备图</h6>
            </div>
            <div class="card-body text-center">
                <img src="<?= Url::to('@web/img/navy-1949-1.jpg') ?>" alt="1949 年海军舰艇示意图" class="img-fluid rounded mb-2" onerror="this.src='<?= Url::to('@web/img/undraw_posting_photo.svg') ?>'">
                <p class="text-muted small mb-0"></p>
            </div>
             <div class="card-body text-center">
                <img src="<?= Url::to('@web/img/navy-1949-2.jpg') ?>" alt="1949 年海军舰艇示意图" class="img-fluid rounded mb-2" onerror="this.src='<?= Url::to('@web/img/undraw_posting_photo.svg') ?>'">
                <p class="text-muted small mb-0"></p>
            </div>
        </div>
    </div>
</div>
