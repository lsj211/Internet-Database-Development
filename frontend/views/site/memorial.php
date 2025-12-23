<?php

/**
 * Team: 抗战纪念队, NKU
 * Coding by chengna 2311828
 * This file is used to display the memorial page for the war heroes.
 */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\ListView;

$this->title = '纪念抗战烈士';
?>

<!-- 页面样式（保留在视图中以便快速迁移） -->
<style>
    /* 自定义抗战主题色调 */
    :root {
        --primary: #8B0000;
        --secondary: #FFD700;
        --success: #228B22;
        --info: #4169E1;
        --warning: #FF6347;
        --danger: #DC143C;
        --light: #FFF8DC;
        --dark: #2F4F4F;
    }
    .bg-gradient-primary { background: linear-gradient(135deg, var(--primary) 0%, #B22222 100%) !important; }
    .text-primary { color: var(--primary) !important; }
    .border-left-primary { border-left: 4px solid var(--primary) !important; }
    .btn-primary { background-color: var(--primary); border-color: var(--primary); }
    .btn-primary:hover { background-color: #A52A2A; border-color: #A52A2A; }
    body { background-image: url('<?= Url::to('@web/img/china-map-bg.jpg') ?>'); background-size: cover; background-attachment: fixed; background-repeat: no-repeat; }
    .card { background: rgba(255,255,255,0.95); backdrop-filter: blur(10px); }

    .memorial-bg { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; }
    .flower { font-size: 2rem; color: #ff6b6b; cursor: pointer; transition: transform 0.3s ease; }
    .flower:hover { transform: scale(1.2); }
    .flower.active { color: #ff4757; animation: pulse 1s infinite; }
    @keyframes pulse { 0% { transform: scale(1); } 50% { transform: scale(1.1); } 100% { transform: scale(1); } }
    .tombstone { background: #f8f9fa; border: 2px solid #dee2e6; border-radius: 10px; padding: 20px; text-align: center; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
    .condolence-card { background: white; border-radius: 10px; padding: 20px; margin-bottom: 15px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
</style>

<div class="memorial-bg">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-transparent">
        <div class="container">
            <a class="navbar-brand" href="index.html">
                <i class="fas fa-flag"></i> 抗战纪念队
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
               <ul class="navbar-nav ml-auto">
    <li class="nav-item">
        <!-- 对应 SiteController 的 actionIndex -->
        <a class="nav-link" href="<?= Url::to(['site/index']) ?>">首页</a>
    </li>
    <li class="nav-item">
        <!-- 假设你有 actionTeam -->
        <a class="nav-link" href="<?= Url::to(['site/team']) ?>">团队介绍</a>
    </li>
    <li class="nav-item">
        <!-- 假设你有 actionHistory -->
        <a class="nav-link" href="<?= Url::to(['site/history']) ?>">抗战历史</a>
    </li>
    <li class="nav-item">
        <!-- 假设你有 actionDownload -->
        <a class="nav-link" href="<?= Url::to(['site/download']) ?>">作业下载</a>
    </li>
    <li class="nav-item active">
        <!-- 指向当前页面 -->
        <a class="nav-link" href="<?= Url::to(['site/memorial']) ?>">烈士纪念</a>
    </li>
    <li class="nav-item">
        <!-- 这里就是报错的地方，现在修好了！指向 SiteController 的 actionParade -->
        <a class="nav-link" href="<?= Url::to(['site/parade']) ?>">阅兵仪式</a>
    </li>
</ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                
                <!-- Header -->
                <div class="text-center text-white mb-5">
                    <h1 class="display-4 font-weight-bold">纪念抗战烈士</h1>
                    <p class="lead">铭记历史，缅怀先烈，致敬英雄</p>
                </div>

                <!-- Memorial Tombstone -->
                <div class="row justify-content-center mb-5">
                    <div class="col-md-8">
                        <div class="tombstone">
                            <h3 class="text-dark mb-3">中国人民抗日战争纪念碑</h3>
                            <p class="text-muted mb-4">1931年-1945年，中国人民抗日战争期间，无数英雄儿女为民族独立和人民解放献出了宝贵生命。</p>
                            
                            <!-- Flower Offering -->
                            <div class="mb-4">
                                <h5 class="text-dark mb-3">献花致敬</h5>
                                <div class="d-flex justify-content-center align-items-center">
                                    <div class="flower mr-3" id="offerFlowerBtn" style="font-size:2.5rem;cursor:pointer;" onclick="offerFlower()">
                                        <i class="fas fa-spa"></i>
                                    </div>
                                    <div>
                                        <div class="h4 mb-0 text-primary" id="flowerCount"><?= number_format($flowerCount) ?></div>
                                        <small class="text-muted">人已献花</small>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Quick Actions -->
                            <div class="row">
                                <div class="col-6">
                                    <button class="btn btn-outline-primary btn-block" onclick="showCondolenceForm()">
                                        <i class="fas fa-feather-alt"></i> 写下追思
                                    </button>
                                </div>
                                <div class="col-6">
                                    <button class="btn btn-outline-success btn-block" onclick="playMemorialVideo()">
                                        <i class="fas fa-video"></i> 播放纪念视频
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Condolence Messages -->
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <h4 class="text-white text-center mb-4">追思留言</h4>
                        
                        <?php foreach (Yii::$app->session->getAllFlashes() as $type => $message): ?>
                            <div class="alert alert-<?= $type ?> alert-dismissible fade show">
                                <?= Html::encode($message) ?>
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                            </div>
                        <?php endforeach; ?>
                        
                        <!-- Condolence Form -->
                        <div class="card mb-4" id="condolenceForm" style="display: none;">
                            <div class="card-body">
                                <h5 class="card-title">写下您的追思</h5>
                                <?php if (Yii::$app->user->isGuest): ?>
                                    <p class="text-muted">
                                        请先 <?= Html::a('登录', Url::to(['site/login'])) ?> 或 <?= Html::a('注册', Url::to(['site/signup'])) ?> 后再留言。
                                    </p>
                                <?php else: ?>
                                    <?php $form = ActiveForm::begin(['action' => ['site/memorial'], 'options' => ['class' => 'form-vertical']]); ?>
                                        <?= $form->field($model, 'content')->textarea(['rows' => 4, 'placeholder' => '写下您对烈士的追思和缅怀...'])->label(false) ?>
                                        <div class="form-group">
                                            <?= Html::submitButton('提交追思', ['class' => 'btn btn-primary']) ?>
                                        </div>
                                    <?php ActiveForm::end(); ?>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Messages List -->
                        <div id="condolenceMessages">
                            <?= ListView::widget([
                                'dataProvider' => $dataProvider,
                                'itemView' => function($model){
                                    /** @var common\models\Message $model */
                                    $username = $model->user ? Html::encode($model->user->username) : '匿名';
                                    $time = Yii::$app->formatter->asDatetime($model->created_at);
                                    return '<div class="condolence-card">'
                                        . '<div class="d-flex justify-content-between align-items-start mb-2">'
                                        . '<strong>' . $username . '</strong>'
                                        . '<small class="text-muted">' . $time . '</small>'
                                        . '</div>'
                                        . '<p class="mb-0">' . nl2br(Html::encode($model->content)) . '</p>'
                                        . '</div>';
                                },
                                'summary' => '',
                                'emptyText' => '<div class="condolence-card text-center text-muted">还没有追思留言，快来写下第一条吧！</div>',
                                'pager' => [
                                    'firstPageLabel' => '首页',
                                    'lastPageLabel' => '末页',
                                    'prevPageLabel' => '上一页',
                                    'nextPageLabel' => '下一页',
                                    'options' => ['class' => 'pagination justify-content-center'],
                                ]
                            ]); ?>
                        </div>
                    </div>
                </div>

                <!-- Statistics -->
                <div class="row mt-5">
                    <div class="col-lg-8 mx-auto">
                        <div class="card bg-white">
                            <div class="card-body">
                                <h5 class="card-title text-center mb-4">纪念数据</h5>
                                <div class="row text-center">
                                    <div class="col-md-4">
                                        <div class="h3 text-primary" id="totalFlowers"><?= number_format($flowerCount) ?></div>
                                        <small class="text-muted">献花总数</small>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="h3 text-success" id="totalMessages"><?= $messageCount ?></div>
                                        <small class="text-muted">追思留言</small>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="h3 text-warning" id="totalViews"><?= number_format($visitCount) ?></div>
                                        <small class="text-muted">访问次数</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

        <!-- Memorial Video Modal -->
        <div class="modal fade" id="memorialVideoModal" tabindex="-1" role="dialog" aria-labelledby="memorialVideoModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="memorialVideoModalLabel">纪念视频</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <video id="memorialVideo" width="100%" controls preload="none">
                            <source id="memorialVideoSource" src="" type="video/mp4">
                            您的浏览器不支持视频播放。
                        </video>
                    </div>
                </div>
            </div>
        </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <script>
        // 献花功能
        function offerFlower() {
            const flower = document.getElementById('offerFlowerBtn');
            flower.classList.add('active');

            fetch('<?= Url::to(['site/offer-flower']) ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: '<?= Yii::$app->request->csrfParam ?>=<?= Yii::$app->request->csrfToken ?>'
            })
            .then(response => response.json())
            .then(data => {
                setTimeout(() => {
                    flower.classList.remove('active');
                }, 1000);
                
                if (data.success) {
                    document.getElementById('flowerCount').textContent = data.count.toLocaleString();
                    document.getElementById('totalFlowers').textContent = data.count.toLocaleString();
                    showNotification(data.message, 'success');
                } else {
                    showNotification(data.message, 'warning');
                }
            })
            .catch(error => {
                flower.classList.remove('active');
                showNotification('献花失败，请稍后重试', 'danger');
            });
        }

        // 显示追思表单
        function showCondolenceForm() {
            const form = document.getElementById('condolenceForm');
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        }

        // 播放纪念视频
        function playMemorialVideo() {
            const modal = $('#memorialVideoModal');
            const video = document.getElementById('memorialVideo');
            const source = document.getElementById('memorialVideoSource');
            
            fetch('<?= Url::to(['site/memorial-video']) ?>')
                .then(res => res.json())
                .then(data => {
                    if (data && data.url) {
                        source.src = data.url;
                        video.load();
                        modal.modal('show');
                        video.play().catch(()=>{});
                    } else {
                        showNotification('未能获取到视频链接', 'danger');
                    }
                })
                .catch(() => showNotification('视频接口请求失败', 'danger'));
        }

        // 关闭弹窗时停止视频，避免仍有声音
        function stopMemorialVideo() {
            const video = document.getElementById('memorialVideo');
            const source = document.getElementById('memorialVideoSource');
            if (video) {
                video.pause();
                video.currentTime = 0;
                video.removeAttribute('src');
                video.load();
            }
            if (source) {
                source.removeAttribute('src');
            }
        }

        $('#memorialVideoModal').on('hide.bs.modal hidden.bs.modal', stopMemorialVideo);
        $('#memorialVideoModal').on('click', '[data-dismiss="modal"]', stopMemorialVideo);

        // 显示通知
        function showNotification(message, type) {
            const notification = document.createElement('div');
            notification.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
            notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
            notification.innerHTML = `
                ${message}
                <button type="button" class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
            `;
            
            document.body.appendChild(notification);
            
            setTimeout(() => {
                $(notification).alert('close');
            }, 3000);
        }
    </script>

</body>

</html>
