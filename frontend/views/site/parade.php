<?php
use yii\helpers\Url;
$this->title = '阅兵仪式';
?>

<style>
    :root { --primary: #8B0000; --secondary: #FFD700; --success: #228B22; --info: #4169E1; --warning: #FF6347; --danger: #DC143C; --light: #FFF8DC; --dark: #2F4F4F; }
    .bg-gradient-primary { background: linear-gradient(135deg, var(--primary) 0%, #B22222 100%) !important; }
    .text-primary { color: var(--primary) !important; }
    body { background-image: url('img/china-map-bg.jpg'); background-size: cover; background-attachment: fixed; background-repeat: no-repeat; }
    .parade-bg { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); min-height: 100vh; }
    .troop-card { background: white; border-radius: 15px; padding: 20px; margin-bottom: 20px; box-shadow: 0 8px 25px rgba(0,0,0,0.1); transition: transform 0.3s ease; }
    .troop-card:hover { transform: translateY(-5px); }
    .formation { display:flex; justify-content:center; align-items:center; margin:20px 0; }
    .soldier { width:30px; height:30px; background:#4a90e2; border-radius:50%; margin:2px; display:inline-block; animation:march 2s infinite; }
    .soldier:nth-child(odd){ background:#7b68ee; }
    @keyframes march { 0%,100%{transform:translateY(0);} 50%{transform:translateY(-3px);} }
    .flag{ font-size:3rem; color:#ff6b6b; animation:wave 3s infinite; }
    @keyframes wave{ 0%,100%{transform:rotate(0deg);} 25%{transform:rotate(5deg);} 75%{transform:rotate(-5deg);} }
    .anthem-player{ background:rgba(255,255,255,0.9); border-radius:10px; padding:20px; text-align:center; }
    .timeline-event{ position:relative; padding-left:30px; margin-bottom:20px; }
    .timeline-event::before{ content:''; position:absolute; left:0; top:0; width:20px; height:20px; background:#4facfe; border-radius:50%; border:3px solid white; box-shadow:0 0 0 3px #4facfe; }
    .timeline-line{ position:absolute; left:10px; top:20px; bottom:-20px; width:2px; background:#4facfe; }
</style>

<div class="parade-bg">

    <nav class="navbar navbar-expand-lg navbar-dark bg-transparent">
        <div class="container">
            <a class="navbar-brand" href="<?= Url::to(['site/index']) ?>">
                <i class="fas fa-flag"></i> 抗战纪念队
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link" href="<?= Url::to(['site/index']) ?>">首页</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= Url::to(['site/team']) ?>">团队介绍</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= Url::to(['site/history']) ?>">抗战历史</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= Url::to(['site/download']) ?>">作业下载</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= Url::to(['site/memorial']) ?>">烈士纪念</a></li>
                    <li class="nav-item active"><a class="nav-link" href="<?= Url::to(['site/parade']) ?>">阅兵仪式</a></li>
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
                    <h1 class="display-4 font-weight-bold">抗战胜利阅兵仪式</h1>
                    <p class="lead">重温历史荣耀，致敬英雄精神</p>
                    <div class="flag mt-4">
                        <i class="fas fa-flag"></i>
                    </div>
                </div>

                <!-- National Anthem Player -->
                <div class="row justify-content-center mb-5">
                    <div class="col-md-8">
                        <div class="anthem-player">
                            <h4 class="mb-3">义勇军进行曲</h4>
                            <audio controls class="w-100" id="anthemAudio">
                                <source src="audio/anthem.mp3" type="audio/mpeg">
                                您的浏览器不支持音频播放。
                            </audio>
                            <div class="mt-2">
                                <button class="btn btn-sm btn-outline-primary" onclick="loadAnthem()">播放</button>
                            </div>
                            <p class="text-muted mt-2 mb-0">点击播放，共同缅怀那段峥嵘岁月</p>
                        </div>
                    </div>
                </div>

                <!-- Parade Formations -->
                <div class="row mb-5">
                    <div class="col-lg-12">
                        <h3 class="text-white text-center mb-4">阅兵方阵</h3>
                        
                        <!-- Infantry Formation -->
                        <div class="troop-card">
                            <div class="row">
                                <div class="col-md-4">
                                    <h5><i class="fas fa-users text-primary"></i> 步兵方阵</h5>
                                    <p>代表着抗日战争中英勇作战的步兵部队</p>
                                    <div class="formation">
                                        <div class="soldier"></div>
                                        <div class="soldier"></div>
                                        <div class="soldier"></div>
                                        <div class="soldier"></div>
                                        <div class="soldier"></div>
                                    </div>
                                    <a href="<?= Url::to(['site/formation','type'=>'infantry']) ?>" class="btn btn-outline-secondary btn-sm btn-block mt-3">查看步兵方阵展示</a>
                                    <div class="formation">
                                        <div class="soldier"></div>
                                        <div class="soldier"></div>
                                        <div class="soldier"></div>
                                        <div class="soldier"></div>
                                        <div class="soldier"></div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h5><i class="fas fa-plane text-success"></i> 空军方阵</h5>
                                    <p>致敬抗日战争中的空中英雄</p>
                                    <div class="formation">
                                        <div class="soldier" style="background: #28a745;"></div>
                                        <div class="soldier" style="background: #28a745;"></div>
                                        <div class="soldier" style="background: #28a745;"></div>
                                    </div>
                                    <a href="<?= Url::to(['site/formation','type'=>'airforce']) ?>" class="btn btn-outline-secondary btn-sm btn-block mt-3">查看空军方阵展示</a>
                                </div>
                                <div class="col-md-4">
                                    <h5><i class="fas fa-ship text-info"></i> 海军方阵</h5>
                                    <p>纪念抗日战争中的海军将士</p>
                                    <div class="formation">
                                        <div class="soldier" style="background: #17a2b8;"></div>
                                        <div class="soldier" style="background: #17a2b8;"></div>
                                    </div>
                                    <a href="<?= Url::to(['site/formation','type'=>'navy']) ?>" class="btn btn-outline-secondary btn-sm btn-block mt-3">查看海军方阵展示</a>
                                </div>
                            </div>
                        </div>

                        <!-- Equipment Display -->
                        <div class="troop-card">
                            <h5 class="text-center mb-4"><i class="fas fa-cogs text-warning"></i> 抗战装备展示</h5>
                            <div class="row">
                                <div class="col-md-3 text-center">
                                    <i class="fas fa-crosshairs fa-3x text-danger mb-2"></i>
                                    <h6>步枪</h6>
                                    <small class="text-muted">抗日战士的主要武器</small>
                                </div>
                                <div class="col-md-3 text-center">
                                    <i class="fas fa-bomb fa-3x text-warning mb-2"></i>
                                    <h6>手榴弹</h6>
                                    <small class="text-muted">近战利器</small>
                                </div>
                                <div class="col-md-3 text-center">
                                    <i class="fas fa-rocket fa-3x text-info mb-2"></i>
                                    <h6>迫击炮</h6>
                                    <small class="text-muted">远程火力支援</small>
                                </div>
                                <div class="col-md-3 text-center">
                                    <i class="fas fa-shield-alt fa-3x text-success mb-2"></i>
                                    <h6>钢盔</h6>
                                    <small class="text-muted">防护装备</small>
                                </div>
                            </div>
                            <a href="<?= Url::to(['site/formation','type'=>'equipment']) ?>" class="btn btn-outline-secondary btn-sm btn-block mt-3">查看装备详细展示</a>
                        </div>
                    </div>
                </div>

                <!-- Historical Timeline -->
                <div class="row mb-5">
                    <div class="col-lg-8 mx-auto">
                        <div class="card bg-white">
                            <div class="card-header">
                                <h5 class="mb-0"><i class="fas fa-history text-primary"></i> 阅兵仪式时间线</h5>
                            </div>
                            <div class="card-body">
                                <div class="timeline-event">
                                    <div class="timeline-line"></div>
                                    <h6>09:00 - 开场仪式</h6>
                                    <p class="text-muted">升国旗，奏国歌，阅兵仪式正式开始</p>
                                </div>
                                <div class="timeline-event">
                                    <div class="timeline-line"></div>
                                    <h6>09:30 - 步兵方阵</h6>
                                    <p class="text-muted">步兵部队接受检阅，展示军容军姿</p>
                                </div>
                                <div class="timeline-event">
                                    <div class="timeline-line"></div>
                                    <h6>10:00 - 空军方阵</h6>
                                    <p class="text-muted">空军部队空中表演，致敬空中英雄</p>
                                </div>
                                <div class="timeline-event">
                                    <div class="timeline-line"></div>
                                    <h6>10:30 - 海军方阵</h6>
                                    <p class="text-muted">海军部队水上表演，纪念海军将士</p>
                                </div>
                                <div class="timeline-event">
                                    <div class="timeline-line"></div>
                                    <h6>11:00 - 装备展示</h6>
                                    <p class="text-muted">抗战时期主要武器装备静态展示</p>
                                </div>
                                <div class="timeline-event">
                                    <h6>11:30 - 闭幕仪式</h6>
                                    <p class="text-muted">阅兵仪式圆满结束</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Interactive Elements -->
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card bg-white mb-4">
                            <div class="card-body text-center">
                                <h5 class="card-title">参与阅兵</h5>
                                <p class="card-text">点击下方按钮，加入虚拟阅兵仪式</p>
                                <button class="btn btn-primary btn-lg" onclick="joinParade()">
                                    <i class="fas fa-user-plus"></i> 加入阅兵
                                </button>
                                <div class="mt-3">
                                    <small class="text-muted">当前参与人数: <span id="participantCount">1,234</span></small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card bg-white mb-4">
                            <div class="card-body text-center">
                                <h5 class="card-title">分享阅兵</h5>
                                <p class="card-text">将这个庄严的时刻分享给更多人</p>
                                <div class="btn-group">
                                    <button class="btn btn-outline-primary" onclick="shareOnWechat()">
                                        <i class="fab fa-weixin"></i> 微信
                                    </button>
                                    <button class="btn btn-outline-info" onclick="shareOnWeibo()">
                                        <i class="fab fa-weibo"></i> 微博
                                    </button>
                                    <button class="btn btn-outline-danger" onclick="shareOnQQ()">
                                        <i class="fab fa-qq"></i> QQ
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Virtual Reality Notice -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card bg-gradient-primary text-white">
                            <div class="card-body text-center">
                                <h5 class="card-title">虚拟现实阅兵体验</h5>
                                <p class="card-text">通过现代技术，重现抗战胜利阅兵的盛大场面，让历史鲜活起来。</p>
                                <button class="btn btn-light btn-lg" onclick="startVRExperience()">
                                    <i class="fas fa-vr-cardboard"></i> 开始VR体验
                                </button>
                                <p class="mt-2 mb-0">
                                    <small>建议使用VR眼镜获得最佳体验</small>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        let participantCount = 1234;
        function joinParade(){ participantCount++; const el = document.getElementById('participantCount'); if(el) el.textContent = participantCount.toLocaleString(); showNotification('欢迎加入阅兵仪式！','success'); addSoldierToFormation(); }
        function addSoldierToFormation(){ const formations = document.querySelectorAll('.formation'); if(!formations.length) return; const randomFormation = formations[Math.floor(Math.random()*formations.length)]; const newSoldier = document.createElement('div'); newSoldier.className='soldier'; newSoldier.style.background='#ff6b6b'; randomFormation.appendChild(newSoldier); }
        function shareOnWechat(){ showNotification('已生成微信分享链接，请复制分享','info'); }
        function shareOnWeibo(){ showNotification('已分享到微博','info'); }
        function shareOnQQ(){ showNotification('已分享到QQ','info'); }
        function startVRExperience(){ showNotification('VR体验功能正在开发中，敬请期待！','warning'); }
        function showNotification(message,type){ const notification=document.createElement('div'); notification.className=`alert alert-${type} alert-dismissible fade show position-fixed`; notification.style.cssText='top:20px; right:20px; z-index:9999; min-width:300px;'; notification.innerHTML=`${message}<button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>`; document.body.appendChild(notification); setTimeout(()=>{ try{ $(notification).alert('close'); }catch(e){ notification.remove(); } },3000); }
        function loadAnthem(){ fetch('<?= Url::to(['site/anthem']) ?>').then(r=>r.json()).then(data=>{ if(data && data.url){ const audio = document.getElementById('anthemAudio'); if(audio){ // replace source
                const src = audio.querySelector('source') || null;
                if(src) src.src = data.url; else audio.innerHTML = `<source src="${data.url}" type="audio/mpeg">`; 
                audio.load(); audio.play().catch(()=>{}); showNotification('已加载并播放国歌','success'); }
            } else { showNotification('未获取到国歌链接','danger'); } }).catch(()=>showNotification('国歌接口请求失败','danger')); }

        document.addEventListener('click', function(){ const audio=document.getElementById('anthemAudio'); if(audio && audio.paused){ /* 可触发播放 */ } }, { once:true });
    </script>

</div>
