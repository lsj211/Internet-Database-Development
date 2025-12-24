<?php
/**
 * Team: 抗战纪念队, NKU
 * Coding by LiuYueshuai 2313752
 * This view presents the 1949 Navy formation details.
 */
/* @var $this yii\web\View */
/* @var $type string */
/* @var $year int */

use yii\helpers\Url;
use yii\helpers\Html;

$this->title = '2025 年海军方阵展示';
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
    <h1 class="h3 mb-0 text-gray-800">2025 年海军方阵</h1>
    <a href="<?= Url::to(['site/formation', 'type' => 'navy']) ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> 返回海军方阵总览
    </a>
</div>

<div class="row">
    <div class="col-lg-8 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">2025 年海军力量展示重点</h6>
            </div>
            <div class="card-body">
                <p>2025 年的海军方阵，往往由多型大型水面舰艇、两栖攻击舰、综合补给舰以及各种辅助舰船组成梯队，在阅兵画面中呈现出“钢铁长龙”一般的壮观场景。这些舰艇不仅代表着水面作战火力，更体现了一个国家在远洋机动、海上补给和综合保障方面的整体实力。</p>
                <p>现代驱逐舰和护卫舰配备了防空、反舰、反潜等多种武器系统，可以独立承担区域防御任务，也可以编入航母战斗群或远洋编队中协同作战。两栖攻击舰则兼具运载部队、搭载直升机和登陸艇等功能，是执行岛礁防御、登陆作战以及海外撤侨、救灾任务的重要平台。</p>
                <p>舰载直升机和无人装备的亮相，则标志着海军由“水面作战”向“立体作战”迈进。反潜直升机可以携带声纳浮标和鱼雷，对潜艇进行搜索和打击；侦察无人机则为舰队提供海面和空中目标的实时图像；未来还可能出现无人水面艇、无人潜航器等新型装备，扩展海军在水下、海面和空中的作战与侦察维度。</p>
                <p>在现代国家安全体系中，海军已经不仅仅是传统意义上的“海上作战力量”，更是国家综合国力和战略威慑的重要组成部分。阅兵中的海军方阵，每一次炮口的转动、舰队的变阵，都是在向世界展示一个国家维护海洋权益、保障海上通道安全、参与国际合作与救援行动的能力与决心。</p>
                <p class="text-muted mt-3"></p>
            </div>
        </div>
    </div>

    <div class="col-lg-4 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">2025 年海军装备图</h6>
            </div>
            <div class="card-body text-center">
                <img src="<?= Url::to('@web/img/navy-2025-1.jpg') ?>" alt="2025 年水面舰艇编队示意图" class="img-fluid rounded mb-2" onerror="this.src='<?= Url::to('@web/img/undraw_posting_photo.svg') ?>'">
                <p class="text-muted small mb-0"></p>
            </div>
             <div class="card-body text-center">
                <img src="<?= Url::to('@web/img/navy-2025-2.jpg') ?>" alt="2025 年水面舰艇编队示意图" class="img-fluid rounded mb-2" onerror="this.src='<?= Url::to('@web/img/undraw_posting_photo.svg') ?>'">
                <p class="text-muted small mb-0"></p>
            </div>
        </div>
    </div>
</div>
