<?php
use yii\helpers\Url;
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
    body { background-image: url('img/china-map-bg.jpg'); background-size: cover; background-attachment: fixed; background-repeat: no-repeat; }
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
        <!-- 注意：留言板通常是独立控制器，指向 message/index -->
        <a class="nav-link" href="<?= Url::to(['message/index']) ?>">留言板</a>
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
                                    <div class="flower mr-3" id="offerFlowerBtn" style="font-size:2.5rem;cursor:pointer;">
                                        <i class="fas fa-spa"></i>
                                    </div>
                                    <div>
                                        <div class="h4 mb-0 text-primary" id="flowerCount">12543</div>
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
                        
                        <!-- Condolence Form -->
                        <div class="card mb-4" id="condolenceForm" style="display: none;">
                            <div class="card-body">
                                <h5 class="card-title">写下您的追思</h5>
                                <form id="messageForm">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="condolenceName" placeholder="您的姓名（可选）" required>
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control" id="condolenceMessage" rows="4" placeholder="写下您对烈士的追思和缅怀..." required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">提交追思</button>
                                </form>
                            </div>
                        </div>

                        <!-- Messages List -->
                        <div id="condolenceMessages">
                            <div class="condolence-card">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <strong>匿名</strong>
                                    <small class="text-muted">2023-12-15 14:30</small>
                                </div>
                                <p class="mb-0">英雄们，你们用生命捍卫了民族的尊严，你们的精神永照后人。致敬！</p>
                            </div>

                            <div class="condolence-card">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <strong>历史研究者</strong>
                                    <small class="text-muted">2023-12-14 16:45</small>
                                </div>
                                <p class="mb-0">在抗日战争中，无数普通中国人展现了非凡的勇气和牺牲精神。他们的事迹将永远铭刻在中华民族的历史上。</p>
                            </div>

                            <div class="condolence-card">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <strong>学生</strong>
                                    <small class="text-muted">2023-12-13 10:20</small>
                                </div>
                                <p class="mb-0">通过学习抗战历史，我深刻感受到和平来之不易。缅怀先烈，珍视和平。</p>
                            </div>
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
                                    <div class="col-md-3">
                                        <div class="h3 text-primary" id="totalFlowers">12,543</div>
                                        <small class="text-muted">献花总数</small>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="h3 text-success" id="totalMessages">156</div>
                                        <small class="text-muted">追思留言</small>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="h3 text-info" id="onlineUsers">89</div>
                                        <small class="text-muted">当前在线</small>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="h3 text-warning" id="totalViews">5,678</div>
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
        // 从localStorage加载数据，如果没有则使用默认值
        let flowerCount = parseInt(localStorage.getItem('flowerCount')) || 12543;
        let messageCount = parseInt(localStorage.getItem('messageCount')) || 156;

        // 页面加载时显示当前数量
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('flowerCount').textContent = flowerCount.toLocaleString();
            document.getElementById('totalFlowers').textContent = flowerCount.toLocaleString();
            document.getElementById('totalMessages').textContent = messageCount;
        });

        // 献花功能
        function offerFlower() {
            const flower = document.querySelector('.flower');
            flower.classList.add('active');

            setTimeout(() => {
                flower.classList.remove('active');
            }, 1000);

            flowerCount++;
            document.getElementById('flowerCount').textContent = flowerCount.toLocaleString();
            document.getElementById('totalFlowers').textContent = flowerCount.toLocaleString();

            // 保存到localStorage
            localStorage.setItem('flowerCount', flowerCount.toString());

            // 显示献花成功提示
            showNotification('献花成功！感谢您的缅怀。', 'success');
        }

        // 显示追思表单
        function showCondolenceForm() {
            const form = document.getElementById('condolenceForm');
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        }

        // 播放纪念视频（通过后端接口获取可替换的视频链接）
        function playMemorialVideo() {
            const modal = $('#memorialVideoModal');
            const video = document.getElementById('memorialVideo');
            const source = document.getElementById('memorialVideoSource');
            // 获取视频链接接口
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

        // 提交追思留言
        document.getElementById('messageForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const name = document.getElementById('condolenceName').value || '匿名';
            const message = document.getElementById('condolenceMessage').value;
            
            // 创建新的留言卡片
            const newCard = document.createElement('div');
            newCard.className = 'condolence-card';
            newCard.innerHTML = `
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <strong>${name}</strong>
                    <small class="text-muted">${new Date().toLocaleString()}</small>
                </div>
                <p class="mb-0">${message}</p>
            `;
            
            // 添加到留言列表顶部
            const messagesContainer = document.getElementById('condolenceMessages');
            messagesContainer.insertBefore(newCard, messagesContainer.firstChild);
            
            // 更新计数
            messageCount++;
            document.getElementById('totalMessages').textContent = messageCount;

            // 保存到localStorage
            localStorage.setItem('messageCount', messageCount.toString());
            
            // 清空表单
            this.reset();
            
            // 隐藏表单
            document.getElementById('condolenceForm').style.display = 'none';
            
            showNotification('追思留言提交成功！', 'success');
        });

        // 显示通知
        function showNotification(message, type) {
            // 创建通知元素
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
            
            // 3秒后自动移除
            setTimeout(() => {
                $(notification).alert('close');
            }, 3000);
        }

        // 模拟实时数据更新
        setInterval(() => {
            const onlineUsers = Math.floor(Math.random() * 20) + 80;
            document.getElementById('onlineUsers').textContent = onlineUsers;
        }, 30000); // 每30秒更新一次

        // 献花数持久化逻辑
        function getFlowerCount() {
            return parseInt(localStorage.getItem('flowerCount') || '12543', 10);
        }
        function setFlowerCount(val) {
            localStorage.setItem('flowerCount', val);
        }
        function updateFlowerCountUI() {
            document.getElementById('flowerCount').textContent = getFlowerCount().toLocaleString();
        }
        document.addEventListener('DOMContentLoaded', updateFlowerCountUI);
        document.getElementById('offerFlowerBtn').onclick = function() {
            let count = getFlowerCount() + 1;
            setFlowerCount(count);
            updateFlowerCountUI();
            this.classList.add('active');
            setTimeout(()=>this.classList.remove('active'), 1000);
        };
    </script>

</body>

</html>