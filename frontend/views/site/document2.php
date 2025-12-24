<?php
/**
 * Team: 抗战纪念队, NKU
 * Coding by LiuYueshuai 2313752
 * This view showcases the second memorial document.
 */
/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = '台儿庄大捷详情';
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
</style>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">台儿庄大捷详情</h1>
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
                        <div class="stat-number">20</div>
                        <div class="stat-label">参战兵力（万人）</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-item">
                        <div class="stat-number">11900</div>
                        <div class="stat-label">日军伤亡（人）</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-item">
                        <div class="stat-number">32</div>
                        <div class="stat-label">缴获大炮（门）</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-item">
                        <div class="stat-number">1</div>
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
                <h6 class="m-0 font-weight-bold text-primary">台儿庄战役经过</h6>
            </div>
            <div class="card-body">
                <div class="document-header">
                    <h4 class="text-center mb-3">台儿庄大捷：抗战史上的光辉篇章</h4>
                    <p class="text-center text-muted">作战时间：1938年3月24日 - 4月7日</p>
                    <p class="text-center text-muted">作战地点：山东省台儿庄地区</p>
                </div>

                <div class="document-content">
                    <h5>战役背景</h5>
                    <p>1938年初，日军占领济南后，分兵南下，企图打通津浦铁路，攻占徐州，威胁武汉。台儿庄位于徐州东北30公里，是徐州的门户，战略地位十分重要。李宗仁指挥第五战区部队，在台儿庄地区布防，决心与日军决战。</p>

                    <h5>作战经过</h5>
                    <p>3月24日，日军矶谷廉介第十师团一部向台儿庄发起进攻。中国守军第二十七集团军张自忠部、第五十七军缪澂流部、第七十七军冯治安部等部队奋起抵抗。双方在台儿庄外围展开激战。</p>

                    <p>3月27日，日军攻入台儿庄，守军与敌展开巷战。池峰城师长亲临前线指挥，士兵们抱着"与城共存亡"的决心，与日军展开肉搏战。战况极为惨烈，台儿庄内房屋大多被炮火摧毁。</p>

                    <p>3月29日，张自忠部从侧翼向日军发起反击。31日，中国军队全线反攻，双方在台儿庄形成对峙。4月3日，中国军队完成对日军的包围，展开总攻。日军腹背受敌，伤亡惨重。</p>

                    <p>4月7日，日军全线崩溃，向北败退。中国军队乘胜追击，收复台儿庄及其附近地区。</p>

                    <h5>战役意义</h5>
                    <p>台儿庄大捷是抗战爆发以来中国军队取得的第一次重大胜利，歼灭日军11900余人，俘虏700余人，缴获大炮32门、机枪200余挺、步枪5000余支，粉碎了日军"三个月灭亡中国"的狂妄计划。</p>

                    <p>这次胜利极大地振奋了全国军民的抗战信心，打破了"日军不可战胜"的神话，提高了中国军队的国际地位，也为国际社会了解中国抗战提供了有力证据。</p>

                    <h5>英雄事迹</h5>
                    <p>战役中涌现出许多可歌可泣的英雄事迹。池峰城师长在战斗中身负重伤，仍坚持指挥；张自忠将军亲临前线，鼓舞士气；无数普通士兵用血肉之躯筑起抗日长城。</p>

                    <p>台儿庄战役的胜利，是中国军民团结抗战精神的集中体现，是中华民族不屈不挠精神的生动写照。</p>
                </div>

                <div class="mt-4">
                    <img src="<?= Url::to('@web/img/document2.jpg') ?>" alt="台儿庄战役照片" class="document-image" onerror="this.src='<?= Url::to('@web/img/document2-2.jpg') ?>'">
                    <p class="text-muted text-center mt-2">台儿庄战役历史照片</p>
                </div>

                <div class="mt-4">
                    <h5>战役影响</h5>
                    <p>台儿庄大捷不仅在军事上重创了日军，更在政治上和精神上产生了重大影响：</p>
                    <ul>
                        <li>粉碎了日军不可战胜的神话，鼓舞了全国抗战信心</li>
                        <li>提高了中国军队的国际地位，赢得了国际社会的尊重</li>
                        <li>证明了国共合作抗战的正确性，推动了抗日民族统一战线的巩固</li>
                        <li>为武汉保卫战和整个抗战持久战创造了有利条件</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
