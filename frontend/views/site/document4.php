<?php
/* @var $this yii\web\View */
/**
 * Team: 抗战纪念队, NKU
 * Coding by LiuYueshuai 2313752
 * This view details the fourth wartime document.
 */
/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = '淞沪会战详情';
$this->params['breadcrumbs'][] = ['label' => '抗战历史', 'url' => ['/site/history']];
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

    .battle-stats {
        background: rgba(255, 255, 255, 0.9);
        padding: 20px;
        border-radius: 5px;
        margin-bottom: 20px;
    }

    .stat-item {
        text-align: center;
        padding: 15px;
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: bold;
        color: var(--primary);
    }

    .stat-label {
        font-size: 0.9rem;
        color: #666;
        margin-top: 5px;
    }
</style>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">淞沪会战详情</h1>
    <a href="<?= Url::to(['/site/history']) ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> 返回历史页面
    </a>
</div>

<div class="row mb-4">
    <div class="col-lg-12">
        <div class="battle-stats">
            <div class="row">
                <div class="col-md-3">
                    <div class="stat-item">
                        <div class="stat-number">70</div>
                        <div class="stat-label">参战兵力（万人）</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-item">
                        <div class="stat-number">90</div>
                        <div class="stat-label">作战天数</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-item">
                        <div class="stat-number">25</div>
                        <div class="stat-label">中国军队伤亡（万人）</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-item">
                        <div class="stat-number">4</div>
                        <div class="stat-label">日军伤亡（万人）</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">淞沪会战概览</h6>
            </div>
            <div class="card-body">
                <div class="document-header">
                    <h4 class="text-center mb-3">淞沪会战：以血肉之躯阻挡侵略铁蹄</h4>
                    <p class="text-center text-muted">作战时间：1937年8月13日 - 11月12日</p>
                    <p class="text-center text-muted">作战地点：上海及淞沪地区</p>
                </div>

                <div class="document-content">
                    <h5>战役背景</h5>
                    <p>卢沟桥事变后，华北战火迅速蔓延。日本帝国主义企图以"北平事变"为突破口，进而全面侵华。为争取国际同情、扭转被动局面，中国政府决定在国际都市上海与日军展开大规模会战，以显示中国抵抗侵略的决心。</p>

                    <h5>战役经过</h5>
                    <p>1937年8月13日，日军借口一名日本海军陆战队士兵在上海被击毙，制造"大场事件"，随即对上海发动进攻。中国军队调集精锐部队，包括第88师、第87师、第36师等，投入淞沪战场。</p>

                    <p>中国守军在闸北、宝山、吴淞口等地与日军展开激烈巷战。四行仓库保卫战中，谢晋元率领的"八百壮士"坚守孤立阵地，抵抗日军多次进攻，成为淞沪会战乃至整个抗战史上的英雄传奇。</p>

                    <p>随着战事升级，日军投入大量海军、空军和装甲部队，并在长江口登陆，企图从侧翼包围中国军队。中国军队在兵力、装备严重劣势的情况下，依然坚持战斗三个多月，重创日军，粉碎了其"三个月灭亡中国"的企图。</p>

                    <h5>战役意义</h5>
                    <p>淞沪会战虽以中国军队被迫撤退告终，但其战略意义极为重大：</p>
                    <ul>
                        <li>粉碎了日本帝国主义速战速决的战略计划</li>
                        <li>为国民政府迁都重庆和大批工厂、学校内迁赢得了宝贵时间</li>
                        <li>向世界展示了中国人民誓死抗战的决心和勇气</li>
                        <li>极大地激发了全国人民的抗日热情</li>
                    </ul>

                    <h5>英雄事迹</h5>
                    <p>四行仓库保卫战中，"八百壮士"坚守孤立阵地四天四夜，以寡敌众，击退日军多次进攻。他们在极端困难的条件下，宁死不屈，成为中华民族不屈精神的象征。</p>

                    <p>淞沪会战中，无数普通士兵、医护人员和市民用血肉之躯构筑起保卫家园的钢铁长城，他们的名字或许无从考证，但他们的牺牲永远镌刻在民族记忆中。</p>
                </div>

                <div class="mt-4">
                    <img src="<?= Url::to('@web/img/document4.jpg') ?>" alt="淞沪会战照片" class="document-image" onerror="this.src='<?= Url::to('@web/img/undraw_posting_photo.svg') ?>'">
                    <p class="text-muted text-center mt-2">淞沪会战历史照片</p>
                </div>
            </div>
        </div>
    </div>
</div>
