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

$this->title = '1949 年抗战装备展示';
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
    <h1 class="h3 mb-0 text-gray-800">1949 年抗战装备展示</h1>
    <a href="<?= Url::to(['site/formation', 'type' => 'equipment']) ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> 返回装备展示总览
    </a>
</div>

<div class="row">
    <div class="col-lg-8 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">1949 年主要地面装备</h6>
            </div>
            <div class="card-body">
                <p>1949 年的地面装备结构，是在长期战争环境中逐步积累和改造的结果。主战装备包括各型中小口径火炮、战时缴获或援助获得的坦克、自行火炮，以及承担运输任务的各类卡车。很多武器型号来源复杂，有的是从侵略者手中缴获的装备，有的是从盟友处获得的支援，还有的则是在简陋工厂里自行改装和仿制的成果。</p>
                <p>在火炮方面，部队配备了各种山炮、野炮和迫击炮，用于支援步兵进攻和防御阵地。虽然口径和射程不如当时世界一流军队的重炮，但通过灵活运用、隐蔽部署和集中火力，仍然能够在关键战役中发挥重要作用。坦克和自行火炮数量相对更少，但在突破坚固工事、冲击敌军防线时，是极具震撼力的“钢铁拳头”。</p>
                <p>运输车辆在当时同样弥足珍贵。许多卡车来自战时接收或修复，承担着运送弹药、粮食、医药和部队的重任。为了保证车辆能够在崎岖道路上行驶，后勤部队和工人们经常在条件极差的环境下进行抢修，不少车辆带着“伤痕”却依然坚持在路上奔跑。</p>
                <p>在新中国成立阅兵中，坦克和火炮方队缓缓驶过天安门广场，车身或许略显斑驳，但阵列却整齐威武。这些装备的背后，是人民在极端困难条件下，自力更生、艰苦奋斗的结晶，也是中华民族结束“装备落后、任人欺凌”历史的一次庄严宣告。</p>
                <p class="text-muted mt-3"></p>
            </div>
        </div>
    </div>

    <div class="col-lg-4 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">1949 年装备示意图</h6>
            </div>
            <div class="card-body text-center">
                <img src="<?= Url::to('@web/img/equipment-1949-1.jpg') ?>" alt="1949 年坦克与火炮编队示意图" class="img-fluid rounded mb-2" onerror="this.src='<?= Url::to('@web/img/undraw_posting_photo.svg') ?>'">
                <p class="text-muted small mb-0"></p>
            </div>
            <div class="card-body text-center">
                <img src="<?= Url::to('@web/img/equipment-1949-2.jpg') ?>" alt="1949 年坦克与火炮编队示意图" class="img-fluid rounded mb-2" onerror="this.src='<?= Url::to('@web/img/undraw_posting_photo.svg') ?>'">
                <p class="text-muted small mb-0"></p>
            </div>
        </div>
    </div>
</div>
