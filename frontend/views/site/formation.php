<?php

/* @var $this yii\web\View */
/* @var $type string */
/* @var $year int|null */

use yii\helpers\Url;
use yii\helpers\Html;

$titleMap = [
    'infantry' => '步兵方阵展示',
    'airforce' => '空军方阵展示',
    'navy' => '海军方阵展示',
    'equipment' => '抗战装备详细展示',
];

$headingMap = [
    'infantry' => '步兵方阵：钢铁长城般的步伐',
    'airforce' => '空军方阵：守卫祖国的蓝天',
    'navy' => '海军方阵：碧海上的不沉舰队',
    'equipment' => '抗战装备：热血与钢铁的记忆',
];

$this->title = $titleMap[$type] ?? '阅兵方阵展示';
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

    .formation-banner {
        min-height: 200px;
        border-radius: 10px;
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 1.5rem;
        margin-bottom: 20px;
    }
</style>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= Html::encode($this->title) ?></h1>
    <a href="<?= Url::to(['/site/parade']) ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> 返回阅兵仪式
    </a>
</div>

<div class="row mb-4">
    <div class="col-lg-12">
        <div class="formation-banner">
            <?= Html::encode($headingMap[$type] ?? '阅兵方阵展示') ?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">详情介绍</h6>
            </div>
            <div class="card-body">
                <?php if ($type === 'infantry'): ?>
                    <p>步兵方阵是阅兵场上的基础力量，代表着千千万万奔赴前线的普通战士。他们肩负钢枪，脚踏正步，用整齐划一的步伐，走出了中华民族不屈不挠的脊梁。</p>
                    <p>在抗日战争中，步兵部队活跃在华北平原、华中大地和滇缅丛林，无论条件多么艰苦，他们始终坚守阵地、浴血奋战，用血肉之躯阻挡了侵略者的铁蹄。</p>
                <?php elseif ($type === 'airforce'): ?>
                    <p>空军方阵象征着守卫祖国蓝天的英雄群体。在抗日战争中，中国空军在极其艰苦的条件下，与装备精良的敌机进行殊死搏斗。</p>
                    <p>从淞沪上空到重庆防空战场，无数飞行员驾驶着战机迎着炮火冲向敌人，把生命化作守护祖国天空的火焰。</p>
                <?php elseif ($type === 'navy'): ?>
                    <p>海军方阵代表着奋战在江海之上的将士们。虽然抗战时期中国海军力量薄弱，但他们依然在长江、黄海等海域与敌人鏖战，用有限的舰炮对抗强敌的舰队。</p>
                    <p>许多海军官兵与战舰共存亡，他们的故事并不广为人知，却同样是抗战史上不可或缺的一部分。</p>
                <?php elseif ($type === 'equipment'): ?>
                    <p>抗战装备展示的是那一段岁月里，战士们手中简陋却顽强的武器。从步枪、手榴弹到迫击炮，每一件装备背后都凝结着无数工人、技术人员和支前群众的心血。</p>
                    <p>在武器极度匮乏的条件下，中国军民通过大生产运动、自制土炮土炸弹等方式，硬是在物质条件极端困难的情况下，坚持了八年的全民抗战。</p>
                <?php endif; ?>

                <hr>

                <h6 class="font-weight-bold mb-3">按年份查看方阵与装备演变</h6>
                <p class="text-muted mb-3">请选择一个年份，了解不同历史阶段中该方阵或装备的典型编成与代表性武器。</p>

                <div class="btn-group mb-4" role="group" aria-label="选择年份">
                    <a href="<?= Url::to(['site/formation', 'type' => $type, 'year' => 1949]) ?>"
                       class="btn btn-sm <?= $year === 1949 ? 'btn-primary' : 'btn-outline-primary' ?>">
                        1949 年阅兵
                    </a>
                    <a href="<?= Url::to(['site/formation', 'type' => $type, 'year' => 2025]) ?>"
                       class="btn btn-sm ml-2 <?= $year === 2025 ? 'btn-primary' : 'btn-outline-primary' ?>">
                        2025 年现代编成
                    </a>
                </div>

                <?php if ($year === 1949): ?>
                    <?php if ($type === 'infantry'): ?>
                        <h6>1949 年步兵方阵</h6>
                        <p>1949 年的步兵方阵以解放军整齐的列队、统一的军装和标准的正步著称。士兵主要携带步枪、轻机枪和少量迫击炮，车辆与装甲装备相对有限，更多体现的是"人海+步炮协同"的作战形态。</p>
                        <p>在阅兵场上，这一方阵象征着新中国武装力量从土地革命战争和抗日战争中走来，以简朴而坚韧的姿态宣告人民军队的诞生与胜利。</p>
                    <?php elseif ($type === 'airforce'): ?>
                        <h6>1949 年空军方阵</h6>
                        <p>1949 年的空军力量仍处在起步阶段，飞机型号和数量有限，多为螺旋桨式战机和运输机。阅兵中的空军方阵，更像是向世界宣告：新中国已经拥有自己的空军，并将逐步建设现代化空中力量。</p>
                    <?php elseif ($type === 'navy'): ?>
                        <h6>1949 年海军方阵</h6>
                        <p>1949 年的海军以改装舰艇、小型炮艇和登陆艇为主，吨位不大，但承担着巡逻沿海、守卫港口的重要任务。阅兵中的海军方阵，展示的是从零起步的人民海军"从小到大、由弱到强"的开端。</p>
                    <?php elseif ($type === 'equipment'): ?>
                        <h6>1949 年典型装备</h6>
                        <p>这一时期，部队装备以缴获和改造的步枪、轻机枪为主，部分部队配备迫击炮和少量火炮。车辆多为卡车和简易运输工具，通讯依靠有线电话、报话机和传令兵。</p>
                    <?php endif; ?>
                <?php elseif ($year === 2025): ?>
                    <?php if ($type === 'infantry'): ?>
                        <h6>2025 年步兵方阵</h6>
                        <p>2025 年的步兵方阵已经向机械化、信息化综合发展，单兵多配备防弹衣、通信设备和夜视装置，班组作战强调步兵战车与步兵协同，形成机动性更强、打击更精确的综合作战单元。</p>
                        <p>在阅兵场上，可以看到整齐划一的现代迷彩、模块化单兵装备，以及代表新时代军队形象的高科技装备展示。</p>
                    <?php elseif ($type === 'airforce'): ?>
                        <h6>2025 年空军方阵</h6>
                        <p>现代空军方阵以多型先进战斗机、预警机和无人机集群为特征，强调"体系对抗"和"信息优势"。空中梯队的编组不仅展示飞行技术，更体现指挥控制、电子战和远程精确打击能力。</p>
                    <?php elseif ($type === 'navy'): ?>
                        <h6>2025 年海军方阵</h6>
                        <p>现代海军方阵通常由大型水面舰艇、两栖登陆舰和辅助舰船组成，体现远洋机动作战和多维立体防御能力。舰载直升机和无人装备的出现，使海军在情报获取和立体打击方面能力大幅提升。</p>
                    <?php elseif ($type === 'equipment'): ?>
                        <h6>2025 年典型装备</h6>
                        <p>在这一时期，地面部队更多配备模块化突击步枪、信息化指挥终端和多用途战术车辆。侦察无人机、精确制导武器和综合防护系统成为常见装备，战场透明度和打击精度大大提高。</p>
                    <?php endif; ?>
                <?php else: ?>
                    <p class="text-muted">（请选择上方的年份按钮，查看不同时期的方阵与装备特点。）</p>
                <?php endif; ?>

                <p class="mt-3 text-muted"></p>
            </div>
        </div>
    </div>
</div>
