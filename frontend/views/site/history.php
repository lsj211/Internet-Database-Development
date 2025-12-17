<?php

/**
 * Team: DBIS, NKU
 * Coding by chengna 2311828
 * This file is used to display the history of the War of Resistance Against Japan.
 */

/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = '抗战历史';
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

    .timeline {
        position: relative;
        padding: 20px 0;
    }
    
    .timeline::before {
        content: '';
        position: absolute;
        left: 30px;
        top: 0;
        bottom: 0;
        width: 2px;
        background: var(--primary);
    }
    
    .timeline-item {
        position: relative;
        margin-bottom: 20px;
        padding-left: 60px;
    }
    
    .timeline-marker {
        position: absolute;
        left: 20px;
        top: 0;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        border: 3px solid #fff;
        z-index: 1;
    }
    
    .timeline-content h5 {
        margin-bottom: 5px;
        color: var(--dark);
    }
    
    .timeline-content p {
        margin: 0;
        color: #666;
    }
</style>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">抗战历史</h1>
    <div>
        <select class="form-control" id="categoryFilter">
            <option value="all">全部</option>
            <option value="timeline">时间轴</option>
            <option value="heroes">英雄人物</option>
            <option value="documents">史料</option>
        </select>
    </div>
</div>

<!-- 时间轴 -->
<div class="row" id="timeline-section">
    <div class="col-lg-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">抗战关键事件时间轴</h6>
            </div>
            <div class="card-body">
                <div class="timeline">
                    <div class="timeline-item">
                        <div class="timeline-marker bg-primary"></div>
                        <div class="timeline-content">
                            <h5>1931年9月18日 - 九一八事变</h5>
                            <p>日本关东军发动九一八事变，占领沈阳，揭开了十四年抗战的序幕。</p>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-marker bg-success"></div>
                        <div class="timeline-content">
                            <h5>1937年7月7日 - 七七事变</h5>
                            <p>日本军队在卢沟桥发动进攻，中国军队奋起抵抗，标志着全民族抗战的开始。</p>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-marker bg-info"></div>
                        <div class="timeline-content">
                            <h5>1937年8月13日 - 淞沪会战</h5>
                            <p>中国军队在上海地区与日军展开大规模会战，展现了中华民族的抗战决心。</p>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-marker bg-warning"></div>
                        <div class="timeline-content">
                            <h5>1945年8月15日 - 日本宣布投降</h5>
                            <p>日本天皇宣布接受《波茨坦公告》，无条件投降，抗日战争取得胜利。</p>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-marker bg-danger"></div>
                        <div class="timeline-content">
                            <h5>1945年9月2日 - 日本正式投降</h5>
                            <p>在东京湾的美国军舰密苏里号上，日本代表签署投降书，抗日战争胜利结束。</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 英雄人物 -->
<div class="row" id="heroes-section">
    <div class="col-lg-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">抗战英雄人物</h6>
                <?php if (!Yii::$app->user->isGuest): ?>
                <div>
                    <a href="<?= Url::to(['/content/edit-hero']) ?>" class="btn btn-sm btn-success">
                        <i class="fas fa-plus"></i> 新建英雄
                    </a>
                </div>
                <?php endif; ?>
            </div>
            <div class="card-body" style="max-height: 600px; overflow-y: auto;">
                <div class="row">
                    <?php foreach ($heroes as $hero): ?>
                    <div class="col-lg-4 col-md-6 mb-3">
                        <div class="card h-100" style="font-size: 0.9rem;">
                            <img class="card-img-top" src="<?= Url::to($hero->image_url) ?>" 
                                 alt="<?= \yii\helpers\Html::encode($hero->name) ?>" 
                                 style="max-height: 200px; object-fit: cover;"
                                 onerror="this.src='<?= Url::to('@web/img/undraw_profile.svg') ?>'">
                            <div class="card-body">
                                <h6 class="card-title mb-2"><?= \yii\helpers\Html::encode($hero->name) ?></h6>
                                <?php if ($hero->title): ?>
                                    <p class="card-text text-muted mb-2"><small><?= \yii\helpers\Html::encode($hero->title) ?></small></p>
                                <?php endif; ?>
                                <?php if ($hero->brief): ?>
                                    <p class="card-text text-truncate mb-2" title="<?= \yii\helpers\Html::encode($hero->brief) ?>"><?= \yii\helpers\Html::encode($hero->brief) ?></p>
                                <?php endif; ?>
                                <?php if ($hero->deeds): ?>
                                    <p class="card-text small mb-1"><strong>事迹：</strong><span class="text-truncate d-inline-block" style="max-width: 90%;" title="<?= \yii\helpers\Html::encode($hero->deeds) ?>"><?= \yii\helpers\Html::encode($hero->deeds) ?></span></p>
                                <?php endif; ?>
                                <?php if ($hero->contribution): ?>
                                    <p class="card-text small mb-1"><strong>贡献：</strong><span class="text-truncate d-inline-block" style="max-width: 90%;" title="<?= \yii\helpers\Html::encode($hero->contribution) ?>"><?= \yii\helpers\Html::encode($hero->contribution) ?></span></p>
                                <?php endif; ?>
                                <?php if ($hero->birth_year || $hero->death_year): ?>
                                    <p class="card-text"><small class="text-muted">
                                        <?= $hero->birth_year ? $hero->birth_year : '?' ?>年 - <?= $hero->death_year ? $hero->death_year : '?' ?>年
                                    </small></p>
                                <?php endif; ?>
                                <?php if (!Yii::$app->user->isGuest): ?>
                                <div class="mt-2">
                                    <a href="<?= Url::to(['/content/edit-hero', 'id' => $hero->id]) ?>" class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i> 编辑
                                    </a>
                                    <a href="<?= Url::to(['/content/delete-hero', 'id' => $hero->id]) ?>" 
                                       class="btn btn-sm btn-danger"
                                       onclick="return confirm('确定要删除吗？')">
                                        <i class="fas fa-trash"></i> 删除
                                    </a>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 史料展示 -->
<div class="row" id="documents-section">
    <div class="col-lg-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">抗战史料</h6>
                <?php if (!Yii::$app->user->isGuest): ?>
                <div>
                    <a href="<?= Url::to(['/content/edit-material']) ?>" class="btn btn-sm btn-success">
                        <i class="fas fa-plus"></i> 新建史料
                    </a>
                </div>
                <?php endif; ?>
            </div>
            <div class="card-body" style="max-height: 600px; overflow-y: auto;">
                <div class="row">
                    <?php foreach ($materials as $material): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <img class="card-img-top" src="<?= Url::to($material->image_url) ?>" 
                                 alt="<?= \yii\helpers\Html::encode($material->title) ?>" 
                                 onerror="this.src='<?= Url::to('@web/img/undraw_posting_photo.svg') ?>'">
                            <div class="card-body">
                                <h5 class="card-title"><?= \yii\helpers\Html::encode($material->title) ?></h5>
                                <?php if ($material->category): ?>
                                    <span class="badge badge-primary mb-2"><?= \yii\helpers\Html::encode($material->category) ?></span>
                                <?php endif; ?>
                                <?php if ($material->event_date): ?>
                                    <p class="card-text"><small class="text-muted"><?= Yii::$app->formatter->asDate($material->event_date, 'php:Y年m月d日') ?></small></p>
                                <?php endif; ?>
                                <?php if ($material->summary): ?>
                                    <p class="card-text"><?= \yii\helpers\Html::encode($material->summary) ?></p>
                                <?php endif; ?>
                                <?php if ($material->source): ?>
                                    <p class="card-text"><small class="text-muted">来源：<?= \yii\helpers\Html::encode($material->source) ?></small></p>
                                <?php endif; ?>
                                <?php if (!Yii::$app->user->isGuest): ?>
                                <div class="mt-2">
                                    <a href="<?= Url::to(['/content/edit-material', 'id' => $material->id]) ?>" class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i> 编辑
                                    </a>
                                    <a href="<?= Url::to(['/content/delete-material', 'id' => $material->id]) ?>" 
                                       class="btn btn-sm btn-danger"
                                       onclick="return confirm('确定要删除吗？')">
                                        <i class="fas fa-trash"></i> 删除
                                    </a>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 数据可视化 -->
<div class="row">
    <div class="col-lg-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">抗战数据统计</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <h6>地理热力分布图</h6>
                        <div class="chart-area">
                            <canvas id="chinaMapChart" style="height: 300px;"></canvas>
                        </div>
                        <p class="mt-2 small">各省战役发生次数及烈士纪念地分布</p>
                    </div>
                    <div class="col-md-6 mb-4">
                        <h6>气泡图：战役分析</h6>
                        <div class="chart-area">
                            <canvas id="bubbleChart" style="height: 300px;"></canvas>
                        </div>
                        <p class="mt-2 small">X轴：时间，Y轴：歼敌数，气泡大小：参战人数(万)</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <h6>折线图：牺牲人数时间线</h6>
                        <div class="chart-area">
                            <canvas id="sacrificeChart" style="height: 300px;"></canvas>
                        </div>
                        <p class="mt-2 small">按时间线记录各时期牺牲人数</p>
                    </div>
                    <div class="col-md-6 mb-4">
                        <h6>饼图：兵种兵力占比</h6>
                        <div class="chart-pie pt-4 pb-2">
                            <canvas id="troopsChart"></canvas>
                        </div>
                        <div class="mt-4 text-center small">
                            <span class="mr-2">
                                <i class="fas fa-circle text-primary"></i> 陆军: 70%
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle text-success"></i> 海军: 15%
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle text-info"></i> 空军: 10%
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle text-warning"></i> 其他: 5%
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <h6>直方图：战士年龄分布</h6>
                        <div class="chart-area">
                            <canvas id="ageChart" style="height: 300px;"></canvas>
                        </div>
                        <p class="mt-2 small">抗日战士年龄分布统计</p>
                    </div>
                    <div class="col-md-6 mb-4">
                        <h6>条形图：战役排名</h6>
                        <div class="chart-area">
                            <canvas id="battleChart" style="height: 300px;"></canvas>
                        </div>
                        <p class="mt-2 small">按牺牲人数和歼敌人数排名</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$this->registerJsFile('https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js', ['depends' => [\yii\web\JqueryAsset::class]]);
$js = <<<JS
// 1. 动态数据生成函数 (Mock Data)
function generateDynamicChartData() {
    const currentYear = new Date().getFullYear();
    const baseYear = 1937;

    // 生成战役次数数据
    const battleCounts = [];
    for (let year = baseYear; year <= 1945; year++) {
        let count;
        if (year === 1937) count = 15 + Math.floor(Math.random() * 5); 
        else if (year >= 1941 && year <= 1944) count = 3 + Math.floor(Math.random() * 4); 
        else count = 8 + Math.floor(Math.random() * 8); 
        battleCounts.push(count);
    }

    // 生成牺牲人数数据
    const sacrificeData = [];
    for (let year = baseYear; year <= 1945; year++) {
        let base = 50;
        if (year === 1938) base = 120; 
        else if (year === 1940) base = 90; 
        else if (year >= 1944) base = 25; 
        sacrificeData.push(base + Math.floor(Math.random() * 30) - 15);
    }

    // 生成地域数据
    const provinces = ["河北", "山西", "山东", "河南", "江苏", "浙江", "湖南", "湖北", "广东", "广西"];
    const provinceData = provinces.map(() => 15 + Math.floor(Math.random() * 35));

    // 生成年龄分布数据
    const ageData = [15000, 45000, 35000, 25000, 15000, 8000, 3000].map(
        base => base + Math.floor(Math.random() * 5000) - 2500
    );

    return {
        battleCounts,
        sacrificeData,
        provinceData,
        ageData
    };
}

// 2. 筛选功能逻辑
document.getElementById('categoryFilter').addEventListener('change', function() {
    const filter = this.value;
    const sections = ['timeline-section', 'heroes-section', 'documents-section'];

    sections.forEach(section => {
        const element = document.getElementById(section);
        if (filter === 'all' || section.includes(filter)) {
            element.style.display = 'block';
        } else {
            element.style.display = 'none';
        }
    });
});

// 3. 初始化图表
const dynamicData = generateDynamicChartData();

// 图表 1: 地理热力分布图
var chinaMapEl = document.getElementById("chinaMapChart");
if (chinaMapEl) {
    var chinaMapChart = new Chart(chinaMapEl, {
        type: 'bar',
        data: {
            labels: ["河北", "山西", "山东", "河南", "江苏", "浙江", "湖南", "湖北", "广东", "广西"],
            datasets: [{
                label: "战役发生次数",
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)', 'rgba(54, 162, 235, 0.6)', 'rgba(255, 206, 86, 0.6)',
                    'rgba(75, 192, 192, 0.6)', 'rgba(153, 102, 255, 0.6)', 'rgba(255, 159, 64, 0.6)',
                    'rgba(199, 199, 199, 0.6)', 'rgba(83, 102, 255, 0.6)', 'rgba(255, 99, 255, 0.6)',
                    'rgba(99, 255, 132, 0.6)'
                ],
                data: dynamicData.provinceData,
            }]
        },
        options: {
            maintainAspectRatio: false,
            scales: { y: { beginAtZero: true } }
        }
    });
}

// 图表 2: 气泡图
var bubbleEl = document.getElementById("bubbleChart");
if (bubbleEl) {
    var bubbleChart = new Chart(bubbleEl, {
        type: 'bubble',
        data: {
            datasets: [{
                label: '淞沪会战',
                data: [{ x: 1937, y: 40, r: 20 }],
                backgroundColor: 'rgba(255, 99, 132, 0.6)'
            }, {
                label: '台儿庄战役',
                data: [{ x: 1938, y: 10, r: 30 }],
                backgroundColor: 'rgba(54, 162, 235, 0.6)'
            }, {
                label: '百团大战',
                data: [{ x: 1940, y: 50, r: 20 }],
                backgroundColor: 'rgba(255, 206, 86, 0.6)'
            }]
        },
        options: {
            maintainAspectRatio: false,
            scales: {
                x: { title: { display: true, text: '时间（年）' }, min: 1935, max: 1942 },
                y: { title: { display: true, text: '歼敌数 (千)' }, beginAtZero: true }
            }
        }
    });
}

// 图表 3: 折线图
var sacrificeEl = document.getElementById("sacrificeChart");
if (sacrificeEl) {
    var sacrificeChart = new Chart(sacrificeEl, {
        type: 'line',
        data: {
            labels: ["1937", "1938", "1939", "1940", "1941", "1942", "1943", "1944", "1945"],
            datasets: [{
                label: "牺牲人数（万）",
                data: dynamicData.sacrificeData,
                borderColor: 'rgba(220, 20, 60, 1)',
                backgroundColor: 'rgba(220, 20, 60, 0.1)',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            maintainAspectRatio: false,
            scales: {
                y: { beginAtZero: true, title: { display: true, text: '牺牲人数（万人）' } }
            }
        }
    });
}

// 图表 4: 饼图
var troopsEl = document.getElementById("troopsChart");
if (troopsEl) {
    var troopsChart = new Chart(troopsEl, {
        type: 'pie',
        data: {
            labels: ['陆军', '海军', '空军', '其他'],
            datasets: [{
                data: [70, 15, 10, 5],
                backgroundColor: [
                    'rgba(139, 0, 0, 0.8)',
                    'rgba(54, 162, 235, 0.8)',
                    'rgba(255, 206, 86, 0.8)',
                    'rgba(75, 192, 192, 0.8)'
                ]
            }]
        },
        options: { maintainAspectRatio: false }
    });
}

// 图表 5: 直方图
var ageEl = document.getElementById("ageChart");
if (ageEl) {
    var ageChart = new Chart(ageEl, {
        type: 'bar',
        data: {
            labels: ["18-20", "21-25", "26-30", "31-35", "36-40", "41-45", "46以上"],
            datasets: [{
                label: "战士数量",
                data: dynamicData.ageData,
                backgroundColor: 'rgba(34, 139, 34, 0.6)',
                borderColor: 'rgba(34, 139, 34, 1)',
                borderWidth: 1
            }]
        },
        options: {
            maintainAspectRatio: false,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
}

// 图表 6: 条形图
var battleEl = document.getElementById("battleChart");
if (battleEl) {
    var battleChart = new Chart(battleEl, {
        type: 'bar',
        data: {
            labels: ["淞沪会战", "徐州会战", "武汉会战", "长沙会战", "百团大战"],
            datasets: [{
                label: "牺牲人数（万）",
                data: [25, 30, 20, 15, 2],
                backgroundColor: 'rgba(220, 20, 60, 0.6)',
            }, {
                label: "歼敌人数（万）",
                data: [5, 8, 6, 4, 2.5],
                backgroundColor: 'rgba(65, 105, 225, 0.6)',
            }]
        },
        options: {
            indexAxis: 'y',
            maintainAspectRatio: false,
            scales: {
                x: { beginAtZero: true }
            }
        }
    });
}
JS;
$this->registerJs($js, \yii\web\View::POS_READY);
?>
