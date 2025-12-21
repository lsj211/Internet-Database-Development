<?php

/* @var $this yii\web\View */
/* @var $type string */
/* @var $year int */

use yii\helpers\Url;
use yii\helpers\Html;

$this->title = '2025 年步兵方阵展示';
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
    <h1 class="h3 mb-0 text-gray-800">2025 年步兵方阵</h1>
    <a href="<?= Url::to(['site/formation', 'type' => 'infantry']) ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> 返回步兵方阵总览
    </a>
</div>

<div class="row">
    <div class="col-lg-8 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">2025 年步兵编成与装备</h6>
            </div>
            <div class="card-body">
                <p>进入信息化时代，2025 年的步兵方阵已经从传统的“步枪 + 轻机枪”模式，发展为以班组为核心、车辆为平台、信息系统为纽带的综合作战单元。每名士兵通常配备新一代制式突击步枪，搭配瞄准镜、战术手电、榴弹发射器等模块化附件，根据任务需求灵活组合。</p>
                <p>在防护方面，步兵广泛配备防弹头盔、防弹衣以及护膝、护肘等防护装具，大大提升了战场生存能力。夜视仪、热成像仪等光电设备，使夜间行军与夜战行动更加常态化；同时，单兵无线电台、战术数据终端等通信设备，将步兵与排、连乃至更高层级的指挥系统实时连接在一起。</p>
                <p>编成上，一个步兵班往往与步兵战车或装甲输送车紧密协同，形成“车＋步”一体的机动作战结构。车辆不仅提供火力支援和装甲防护，还承担部分侦察、通信和补给任务，使得小规模单元也具备较强的综合作战能力。</p>
                <p>在阅兵场上，2025 年的步兵方阵不再只是“人数”的展示，而是现代军队整体素质的集中体现。统一的数码迷彩、整齐的单兵装备、稳定有力的正步，背后是一整套严格的体能训练、射击训练和协同训练体系。通过短短几十秒的通过时间，向观众呈现的是一支能够快速机动、信息共享、精确打击的现代化步兵力量。</p>
                <p class="text-muted mt-3"></p>
            </div>
        </div>
    </div>

    <div class="col-lg-4 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">2025 年步兵形象图</h6>
            </div>
            <div class="card-body text-center">
                <img src="<?= Url::to('@web/img/infantry-2025-1.jpg') ?>" alt="2025 年步兵方阵示意图" class="img-fluid rounded mb-2" onerror="this.src='<?= Url::to('@web/img/undraw_posting_photo.svg') ?>'">
                <p class="text-muted small mb-0"></p>
            </div>

             <div class="card-body text-center">
                <img src="<?= Url::to('@web/img/infantry-2025-2.jpg') ?>" alt="2025 年步兵方阵示意图" class="img-fluid rounded mb-2" onerror="this.src='<?= Url::to('@web/img/undraw_posting_photo.svg') ?>'">
                <p class="text-muted small mb-0"></p>
            </div>
        </div>
    </div>
</div>
