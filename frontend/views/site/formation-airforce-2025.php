<?php
/**
 * Team: 抗战纪念队, NKU
 * Coding by LiuYueshuai 2313752
 * This view presents the 1949 Air Force formation details.
 */
/* @var $this yii\web\View */
/* @var $type string */
/* @var $year int */

use yii\helpers\Url;
use yii\helpers\Html;

$this->title = '2025 年空军方阵展示';
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
    <h1 class="h3 mb-0 text-gray-800">2025 年空军方阵</h1>
    <a href="<?= Url::to(['site/formation', 'type' => 'airforce']) ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> 返回空军方阵总览
    </a>
</div>

<div class="row">
    <div class="col-lg-8 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">2025 年空中力量展示重点</h6>
            </div>
            <div class="card-body">
                <p>2025 年的空军方阵，是一个国家综合空中力量的集中缩影。多型先进战斗机以楔形、箭形或楔队等队形飞过阅兵场上空，有的主攻制空作战，有的侧重对地攻击和远程打击；机身涂装和机翼标志，在蓝天白云映衬下格外醒目，展现出新一代战机的高机动性和高信息化水平。</p>
                <p>除了战斗机外，预警机、加油机和大型运输机组成的“支援梯队”同样引人注目。预警机在整个空中编队中扮演“空中指挥所”的角色，负责态势感知和目标指示；加油机则提供远程作战的续航能力；运输机则代表着战略投送和人道主义救援的能力，这些机种共同构成现代空军“能打仗、打胜仗”的重要基础。</p>
                <p>无人机集群的出现，则是信息时代空中力量发展的新方向。小型侦察无人机、攻击无人机、电子对抗无人机可以在不同高度和区域协同行动，为战场提供源源不断的情报和火力支援。在阅兵场景中，它们往往以编队或编组的形式飞过，象征着未来战争中“有人－无人融合”的作战模式。</p>
                <p>在现代阅兵中，空军不再只是简单“飞过天安门”的画面，而是通过多波次、多高度、多机型的编组变化，展现空军在夺取制空权、实施远程精确打击、战略威慑和非战争军事行动中的综合能力。每一次轰鸣而过的引擎声，背后都是一个完整的空天力量体系。</p>
                <p class="text-muted mt-3"></p>
            </div>
        </div>
    </div>

    <div class="col-lg-4 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">2025 年空军装备图</h6>
            </div>
            <div class="card-body text-center">
                <img src="<?= Url::to('@web/img/airforce-2025-1.jpg') ?>" alt="2025 年空中梯队示意图" class="img-fluid rounded mb-2" onerror="this.src='<?= Url::to('@web/img/undraw_posting_photo.svg') ?>'">
                <p class="text-muted small mb-0"></p>
            </div>
             <div class="card-body text-center">
                <img src="<?= Url::to('@web/img/airforce-2025-2.jpg') ?>" alt="2025 年空中梯队示意图" class="img-fluid rounded mb-2" onerror="this.src='<?= Url::to('@web/img/undraw_posting_photo.svg') ?>'">
                <p class="text-muted small mb-0"></p>
            </div>
        </div>
    </div>
</div>
