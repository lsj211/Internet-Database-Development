<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = '百团大战详情';
$this->params['breadcrumbs'][] = ['label' => '抗战历史', 'url' => ['/site/history']];
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
    /* 抗战主题背景图片 */
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

    .phase-section {
        margin-bottom: 20px;
        padding: 15px;
        background: rgba(255, 255, 255, 0.5);
        border-left: 4px solid var(--primary);
    }
</style>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">百团大战详情</h1>
    <a href="<?= Url::to(['/site/history']) ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> 返回历史页面
    </a>
</div>

<!-- 战役统计 -->
<div class="row mb-4">
    <div class="col-lg-12">
        <div class="battle-stats">
            <div class="row">
                <div class="col-md-3">
                    <div class="stat-item">
                        <div class="stat-number">105</div>
                        <div class="stat-label">参战团数</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-item">
                        <div class="stat-number">20000</div>
                        <div class="stat-label">日军伤亡（人）</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-item">
                        <div class="stat-number">293</div>
                        <div class="stat-label">破坏铁路（公里）</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-item">
                        <div class="stat-number">3.5</div>
                        <div class="stat-label">月作战时间</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 文档内容 -->
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">百团大战全过程</h6>
            </div>
            <div class="card-body">
                <div class="document-header">
                    <h4 class="text-center mb-3">百团大战：抗日战争的战略转折</h4>
                    <p class="text-center text-muted">作战时间：1940年8月20日 - 12月5日</p>
                    <p class="text-center text-muted">作战地域：华北地区主要交通线</p>
                </div>

                <div class="document-content">
                    <h5>战役背景</h5>
                    <p>1940年，抗日战争进入相持阶段，日军对华北根据地实行"囚笼政策"，在铁路沿线修筑大量据点，分割封锁抗日根据地。八路军总部决定发动大规模破袭战，破坏日军交通线，粉碎其"囚笼政策"。</p>

                    <p>彭德怀副总司令亲自部署，组织了105个团约20万兵力参加作战。这次战役被命名为"百团大战"。</p>

                    <h5>作战分三个阶段</h5>

                    <div class="phase-section">
                        <h6>第一阶段：交通总破袭战（8月20日-9月10日）</h6>
                        <p>重点破坏正太铁路、平汉铁路、同蒲铁路等主要交通线。八路军战士们冒着生命危险，炸桥梁、拆铁轨、烧枕木，使日军交通瘫痪。</p>
                        <p>在正太铁路线上，八路军炸毁桥梁190座，火车站10个，破坏铁路260公里。在同蒲铁路线上，破坏铁路150公里。</p>
                    </div>

                    <div class="phase-section">
                        <h6>第二阶段：扩大战果，攻坚据点（9月11日-10月上旬）</h6>
                        <p>趁日军混乱之际，八路军向交通线两侧的日军据点发起进攻。攻克榆社、辽县、和顺等县城，歼灭大量日伪军。</p>
                        <p>在涞灵战役中，八路军全歼日军一个大队。在榆辽战役中，攻克县城7座，歼敌4000余人。</p>
                    </div>

                    <div class="phase-section">
                        <h6>第三阶段：反"扫荡"作战（10月下旬-12月5日）</h6>
                        <p>日军调集重兵进行报复"扫荡"。八路军各部队开展反"扫荡"作战，保存有生力量，巩固胜利成果。</p>
                        <p>经过3个半月的作战，百团大战胜利结束。</p>
                    </div>

                    <h5>战役成果</h5>
                    <p>百团大战取得了重大胜利：</p>
                    <ul>
                        <li>歼灭日军20645人，伪军5155人</li>
                        <li>破坏铁路947公里，公路3000余公里</li>
                        <li>破坏桥梁259座，火车站37个</li>
                        <li>缴获各种炮53门，机枪281挺</li>
                        <li>攻克据点2993个</li>
                    </ul>

                    <h5>历史意义</h5>
                    <p>百团大战是抗日战争中八路军在华北地区发动的最大规模的战役，是抗日战争的战略转折点：</p>
                    <ul>
                        <li>打破了日军的"囚笼政策"，恢复了华北抗日根据地的部分主动权</li>
                        <li>提高了中国共产党和八路军的国际声誉</li>
                        <li>鼓舞了全国人民的抗战信心，增强了抗战必胜的信念</li>
                        <li>证明了共产党领导的抗日武装是抗日战争的中流砥柱</li>
                    </ul>

                    <h5>英雄赞歌</h5>
                    <p>百团大战中涌现出无数英雄人物。狼牙山五壮士的传奇故事，晋察冀军区某部战士在敌后坚持战斗的精神，都成为抗日战争的经典篇章。</p>

                    <p>左权将军在百团大战中不幸殉国，他的牺牲精神激励着一代又一代的中国人。</p>
                </div>

                <div class="mt-4">
                    <img src="<?= Url::to('@web/img/document3.jpg') ?>" alt="百团大战照片" class="document-image" onerror="this.src='<?= Url::to('@web/img/undraw_posting_photo.svg') ?>'">
                    <p class="text-muted text-center mt-2">百团大战历史照片</p>
                </div>

                <div class="mt-4">
                    <h5>战役影响</h5>
                    <p>百团大战不仅在军事上重创了日军，更在政治上产生了深远影响：</p>
                    <ul>
                        <li>打破了日军不可战胜的神话，振奋了全国军民抗战士气</li>
                        <li>提高了中国共产党的国际威望，赢得了世界人民的尊重</li>
                        <li>巩固和发展了抗日民族统一战线</li>
                        <li>为抗日战争的最后胜利奠定了坚实基础</li>
                    </ul>
                    <p>百团大战的胜利，是中国共产党领导抗日战争的伟大成就，是中华民族不屈精神的集中体现。</p>
                </div>
            </div>
        </div>
    </div>
</div>
