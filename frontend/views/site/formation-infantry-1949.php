<?php
/**
 * Team: 抗战纪念队, NKU
 * Coding by LiuYueshuai 2313752
 * This view presents the 1949 Infantry formation details.
 */
/* @var $this yii\web\View */
/* @var $type string */
/* @var $year int */

use yii\helpers\Url;
use yii\helpers\Html;

$this->title = '1949 年步兵方阵展示';
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
    <h1 class="h3 mb-0 text-gray-800">1949 年步兵方阵</h1>
    <a href="<?= Url::to(['site/formation', 'type' => 'infantry']) ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> 返回步兵方阵总览
    </a>
</div>

<div class="row">
    <div class="col-lg-8 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">1949 年步兵编成与形象</h6>
            </div>
            <div class="card-body">
                <p>1949 年的新中国成立阅兵，是人民军队由战争年代走向和平建设的历史节点。步兵方阵以整齐划一的列队、统一的军装和标准的正步，通过铿锵有力的步伐，向全国人民展示出一支人民军队的全新形象。士兵多身着粗布军装或简易作战服，脚穿解放鞋，肩扛步枪，很多人身上仍带着战场上的痕迹，却在阅兵场上用最标准的动作向共和国庄严敬礼。</p>
                <p>从编制上看，这一时期的步兵单位仍然延续着战争年代形成的结构：以步枪班为基本作战单元，由班长带领若干名士兵，配备轻机枪手、掷弹手等角色；排、连则在此基础上叠加，辅以机枪排、迫击炮排等火力支援力量。由于装备来源复杂，很多武器是从敌军缴获或从各个战场集中而来，口径与型号并不统一，但在战士手中依然发挥了巨大威力。</p>
                <p>战术运用上，步兵部队熟悉山地、丛林、平原等多种地形作战，善于利用地形隐蔽接近敌人，在近距离突然发起冲锋。正是依靠这种灵活机动、敢打敢拼的作风，他们在长期战争中积累了丰富的战斗经验。1949 年的步兵方阵背后，站立的是千千万万曾经参加过长征、平型关、台儿庄、辽沈、淮海、平津等战役的老兵。</p>
                <p>对于群众来说，阅兵中的步兵方阵不仅仅是武装力量的展示，更是一种情感的寄托。人们在这支队伍中，看到了八年抗战和三年解放战争中无数烈士的身影，看到了新中国不再受辱、人民真正站起来的希望。</p>
                <p class="text-muted mt-3"></p>
            </div>
        </div>
    </div>

    <div class="col-lg-4 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">1949 年步兵形象图</h6>
            </div>
            <div class="card-body text-center">
                <img src="<?= Url::to('@web/img/infantry-1949-1.jpg') ?>" alt="1949 年步兵方阵示意图" class="img-fluid rounded mb-2" onerror="this.src='<?= Url::to('@web/img/undraw_posting_photo.svg') ?>'">
                <p class="text-muted small mb-0"></p>
            </div>
            <div class="card-body text-center">
                <img src="<?= Url::to('@web/img/infantry-1949-2.jpg') ?>" alt="1949 年步兵方阵示意图" class="img-fluid rounded mb-2" onerror="this.src='<?= Url::to('@web/img/undraw_posting_photo.svg') ?>'">
                <p class="text-muted small mb-0"></p>
            </div>
        </div>
    </div>
</div>
