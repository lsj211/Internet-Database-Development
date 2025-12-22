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
                    <p class="text-light"><i class="fas fa-eye"></i> 本页访问量: <strong><?= isset($visitCount) ? number_format($visitCount) : 0 ?></strong> 次</p>
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
                    <div class="col-lg-12">
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
                </div>

                <!-- Parade Quiz -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card bg-gradient-primary text-white mb-4">
                            <div class="card-body text-center">
                                <h5 class="card-title">阅兵知识小测验</h5>
                                <p class="card-text mb-3">通过 5 道小题，检验一下你对阅兵流程、方阵和抗战历史的了解程度。</p>
                                <button class="btn btn-light btn-lg" onclick="openParadeQuiz()">
                                    <i class="fas fa-question-circle"></i> 开始答题
                                </button>
                                <p class="mt-2 mb-0">
                                    <small>答完后会给出得分和简单评价，欢迎多次挑战。</small>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- 阅兵知识小测验 Modal -->
    <div class="modal fade" id="paradeQuizModal" tabindex="-1" role="dialog" aria-labelledby="paradeQuizModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paradeQuizModalLabel">阅兵知识小测验</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="paradeQuizForm">
                        <div class="mb-3" data-quiz-question="1">
                            <p class="font-weight-bold">1. 在本页面设计的阅兵时间线中，哪一个环节标志着阅兵正式开始？</p>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" name="q1" id="q1a" value="a">
                                <label class="custom-control-label" for="q1a">A. 步兵方阵通过天安门</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" name="q1" id="q1b" value="b">
                                <label class="custom-control-label" for="q1b">B. 升国旗，奏国歌</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" name="q1" id="q1c" value="c">
                                <label class="custom-control-label" for="q1c">C. 装备展示开始</label>
                            </div>
                        </div>

                        <div class="mb-3" data-quiz-question="2">
                            <p class="font-weight-bold">2. 在本系统的阅兵流程中，哪一个方阵最先接受检阅？</p>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" name="q2" id="q2a" value="a">
                                <label class="custom-control-label" for="q2a">A. 海军方阵</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" name="q2" id="q2b" value="b">
                                <label class="custom-control-label" for="q2b">B. 步兵方阵</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" name="q2" id="q2c" value="c">
                                <label class="custom-control-label" for="q2c">C. 空军方阵</label>
                            </div>
                        </div>

                        <div class="mb-3" data-quiz-question="3">
                            <p class="font-weight-bold">3. 本系统中，哪一个模块主要用于回顾抗战中的英雄人物与历史事件？</p>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" name="q3" id="q3a" value="a">
                                <label class="custom-control-label" for="q3a">A. 抗战历史板块</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" name="q3" id="q3b" value="b">
                                <label class="custom-control-label" for="q3b">B. 作业下载板块</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" name="q3" id="q3c" value="c">
                                <label class="custom-control-label" for="q3c">C. 团队介绍板块</label>
                            </div>
                        </div>

                        <div class="mb-3" data-quiz-question="4">
                            <p class="font-weight-bold">4. 阅兵中的“抗战装备展示”主要体现了哪一方面的内容？</p>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" name="q4" id="q4a" value="a">
                                <label class="custom-control-label" for="q4a">A. 仅展示现代高科技武器</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" name="q4" id="q4b" value="b">
                                <label class="custom-control-label" for="q4b">B. 展示抗战时期战士使用的典型装备</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" name="q4" id="q4c" value="c">
                                <label class="custom-control-label" for="q4c">C. 只展示礼仪用旗帜与服装</label>
                            </div>
                        </div>

                        <div class="mb-1" data-quiz-question="5">
                            <p class="font-weight-bold">5. 本系统的“参与阅兵”按钮，主要想营造怎样的一种体验？</p>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" name="q5" id="q5a" value="a">
                                <label class="custom-control-label" for="q5a">A. 用户可以真正报名参加现实中的阅兵</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" name="q5" id="q5b" value="b">
                                <label class="custom-control-label" for="q5b">B. 通过虚拟人数和动画，增加参与感和互动性</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" name="q5" id="q5c" value="c">
                                <label class="custom-control-label" for="q5c">C. 用来统计真实报名人数并上报后台</label>
                            </div>
                        </div>
                    </form>
                    <div id="paradeQuizResult" class="mt-3 text-center text-primary font-weight-bold" style="display:none;"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary" id="paradeQuizNextBtn" onclick="submitParadeQuizStep()">提交本题</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let participantCount = 1234;
        function joinParade(){ participantCount++; const el = document.getElementById('participantCount'); if(el) el.textContent = participantCount.toLocaleString(); showNotification('欢迎加入阅兵仪式！','success'); addSoldierToFormation(); }
        function addSoldierToFormation(){ const formations = document.querySelectorAll('.formation'); if(!formations.length) return; const randomFormation = formations[Math.floor(Math.random()*formations.length)]; const newSoldier = document.createElement('div'); newSoldier.className='soldier'; newSoldier.style.background='#ff6b6b'; randomFormation.appendChild(newSoldier); }

        // 阅兵知识小测验逻辑：逐题作答，答错给出解析，然后进入下一题

        const paradeQuizConfig = {
            total: 5,
            answers: {
                q1: {
                    correct: 'b',
                    explanation: '在时间线里写明：09:00 升国旗、奏国歌，阅兵仪式正式开始，所以 B 是正确答案。'
                },
                q2: {
                    correct: 'b',
                    explanation: '时间线中 09:30 是步兵方阵接受检阅，走在空军和海军前面，所以最先接受检阅的是步兵方阵。'
                },
                q3: {
                    correct: 'a',
                    explanation: '“抗战历史”板块集中展示英雄人物、历史事件和史料详情，是回顾抗战历史的主要模块。'
                },
                q4: {
                    correct: 'b',
                    explanation: '本页面中的“抗战装备展示”介绍的是抗战时期战士使用的典型装备，而不是单纯的现代高科技武器或礼仪用品。'
                },
                q5: {
                    correct: 'b',
                    explanation: '“参与阅兵”通过增加虚拟人数、加入小人动画，营造的是一种互动参与感，而不是现实报名统计。'
                }
            }
        };

        let paradeQuizCurrent = 1;
        let paradeQuizScore = 0;

        function showParadeQuizQuestion(index){
            const blocks = document.querySelectorAll('#paradeQuizForm [data-quiz-question]');
            blocks.forEach(function(block){
                const v = parseInt(block.getAttribute('data-quiz-question'), 10);
                block.style.display = (v === index) ? '' : 'none';
            });

            const btn = document.getElementById('paradeQuizNextBtn');
            if (btn) {
                if (index < paradeQuizConfig.total) {
                    btn.textContent = `提交本题并进入下一题 (${index}/${paradeQuizConfig.total})`;
                } else {
                    btn.textContent = `提交最后一题 (${index}/${paradeQuizConfig.total})`;
                }
            }
        }

        function resetParadeQuiz(){
            paradeQuizCurrent = 1;
            paradeQuizScore = 0;

            const form = document.getElementById('paradeQuizForm');
            if (form && typeof form.reset === 'function') {
                form.reset();
            }
            const resultEl = document.getElementById('paradeQuizResult');
            if (resultEl) {
                resultEl.style.display = 'none';
                resultEl.textContent = '';
            }
            showParadeQuizQuestion(paradeQuizCurrent);
        }

        function openParadeQuiz(){
            try {
                $('#paradeQuizModal').modal('show');
            } catch (e) {
                // 如果 Bootstrap JS 未加载，仍然保证内容可见
                const modal = document.getElementById('paradeQuizModal');
                if (modal) modal.style.display = 'block';
            }
            resetParadeQuiz();
        }

        function submitParadeQuizStep(){
            const form = document.getElementById('paradeQuizForm');
            if (!form) return;

            const qName = 'q' + paradeQuizCurrent;
            const config = paradeQuizConfig.answers[qName];
            if (!config) return;

            const checked = form.querySelector('input[name="' + qName + '"]:checked');
            if (!checked) {
                showNotification('请先选择本题的一个选项','warning');
                return;
            }

            if (checked.value === config.correct) {
                paradeQuizScore++;
                showNotification('回答正确！继续下一题～','success');
            } else {
                showNotification('回答错误：' + config.explanation, 'danger');
            }

            // 进入下一题或展示总结果
            if (paradeQuizCurrent < paradeQuizConfig.total) {
                paradeQuizCurrent++;
                showParadeQuizQuestion(paradeQuizCurrent);
            } else {
                const resultEl = document.getElementById('paradeQuizResult');
                if (resultEl) {
                    let msg = `本次你一共答对 ${paradeQuizScore} / ${paradeQuizConfig.total} 题。`;
                    if (paradeQuizScore === paradeQuizConfig.total) {
                        msg += ' 太棒了，你对阅兵流程和本系统非常熟悉！';
                    } else if (paradeQuizScore >= 3) {
                        msg += ' 表现不错，对阅兵已经有比较全面的了解。';
                    } else {
                        msg += ' 建议多看看“抗战历史”和各个方阵页面，再来挑战一次！';
                    }
                    resultEl.textContent = msg;
                    resultEl.style.display = 'block';
                }

                const btn = document.getElementById('paradeQuizNextBtn');
                if (btn) {
                    btn.textContent = '重新开始小测验';
                    btn.onclick = function(){ resetParadeQuiz(); };
                }
            }
        }
        function showNotification(message,type){ const notification=document.createElement('div'); notification.className=`alert alert-${type} alert-dismissible fade show position-fixed`; notification.style.cssText='top:20px; right:20px; z-index:9999; min-width:300px;'; notification.innerHTML=`${message}<button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>`; document.body.appendChild(notification); setTimeout(()=>{ try{ $(notification).alert('close'); }catch(e){ notification.remove(); } },3000); }
        function loadAnthem(){ fetch('<?= Url::to(['site/anthem']) ?>').then(r=>r.json()).then(data=>{ if(data && data.url){ const audio = document.getElementById('anthemAudio'); if(audio){ // replace source
                const src = audio.querySelector('source') || null;
                if(src) src.src = data.url; else audio.innerHTML = `<source src="${data.url}" type="audio/mpeg">`; 
                audio.load(); audio.play().catch(()=>{}); showNotification('已加载并播放国歌','success'); }
            } else { showNotification('未获取到国歌链接','danger'); } }).catch(()=>showNotification('国歌接口请求失败','danger')); }

        document.addEventListener('click', function(){ const audio=document.getElementById('anthemAudio'); if(audio && audio.paused){ /* 可触发播放 */ } }, { once:true });
    </script>

</div>
