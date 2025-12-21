<?php

/* @var $this yii\web\View */
/* @var $type string */
/* @var $year int */

use yii\helpers\Url;
use yii\helpers\Html;

$this->title = '2025 年抗战装备展示';
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
    <h1 class="h3 mb-0 text-gray-800">2025 年抗战装备展示</h1>
    <a href="<?= Url::to(['site/formation', 'type' => 'equipment']) ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> 返回装备展示总览
    </a>
</div>

<div class="row">
    <div class="col-lg-8 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">2025 年现代地面装备</h6>
            </div>
            <div class="card-body">
                <p>2025 年的地面装备方阵，以新一代主战坦克、轮式和履带式步兵战车、自行火炮、防空系统以及各类保障车辆为代表，体现的是“火力、防护、机动、信息”四个维度的综合统一。与 1949 年相比，这些装备普遍具备更强的机动性、更厚实的装甲防护以及更远、更精准的打击能力。</p>
                <p>主战坦克配备大口径滑膛炮和先进的火控系统，可以在复杂气象条件和昼夜环境下实施精确射击；复合装甲和主动防护系统则显著提升了战场生存能力。步兵战车和装甲输送车则为步兵提供快速机动和装甲防护，同时搭载自动炮、机枪和对坦克导弹，为步兵提供直接火力支援。</p>
                <p>自行火炮和远程火箭炮系统，是现代陆军远程火力打击的重要支柱。它们通过卫星导航、惯导系统和数字火控，实现快速占领阵地、迅速射击、立即机动的“打了就走”战术，大幅提高了打击效率和生存概率。野战防空系统则通过导弹和炮弹结合的方式，为地面部队提供低空和超低空防护，对敌方直升机、无人机和巡航导弹构成有力威胁。</p>
                <p>更为重要的是，现代信息化系统的加入，让每一台装备不再是“孤立作战单位”，而是联合作战网络中的一个节点。战场态势可以在指挥车、坦克、步战车和前沿侦察单元之间实时共享，后勤补给状态也可以通过信息系统进行动态管理，使整支部队在复杂战场环境中保持高效运转。</p>
                <p>在阅兵中，这些装备往往按照作战编制成梯队依次通过：坦克方队、自行火炮方队、防空导弹方队、后勤保障方队等有序登场，既展示了硬件性能，也呈现了现代陆军在指挥控制、侦察预警和综合保障方面的整体能力，是一支现代化军队陆上作战体系的缩影。</p>
                <p class="text-muted mt-3"></p>
            </div>
        </div>
    </div>

    <div class="col-lg-4 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">2025 年装备示意图</h6>
            </div>
            <div class="card-body text-center">
                <img src="<?= Url::to('@web/img/equipment-2025-1.jpg') ?>" alt="2025 年地面装备编队示意图" class="img-fluid rounded mb-2" onerror="this.src='<?= Url::to('@web/img/undraw_posting_photo.svg') ?>'">
                <p class="text-muted small mb-0"></p>
            </div>
            <div class="card-body text-center">
                <img src="<?= Url::to('@web/img/equipment-2025-2.jpg') ?>" alt="2025 年地面装备编队示意图" class="img-fluid rounded mb-2" onerror="this.src='<?= Url::to('@web/img/undraw_posting_photo.svg') ?>'">
                <p class="text-muted small mb-0"></p>
            </div>
        </div>
    </div>
</div>
