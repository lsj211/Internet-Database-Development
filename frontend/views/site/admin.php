<?php

/* @var $this yii\web\View */

$this->title = '后台管理仪表板';
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">后台管理仪表板</h1>
</div>

<!-- Content Row -->
<div class="row">

    <!-- 留言统计 -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            总留言数</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">127</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 待审核留言 -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            待审核留言</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">5</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clock fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 页面访问量 -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">页面访问量
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">2,543</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-eye fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 作业下载次数 -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            作业下载次数</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">156</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-download fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content Row -->
<div class="row">

    <!-- 最近留言 -->
    <div class="col-lg-6 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">最近留言</h6>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    <div class="list-group-item">
                        <div class="d-flex justify-content-between">
                            <strong>匿名用户</strong>
                            <small>2023-12-15 10:30</small>
                        </div>
                        <p class="mb-1">非常感谢你们制作这个网站...</p>
                        <small class="text-muted">状态：已审核</small>
                    </div>
                    <div class="list-group-item">
                        <div class="d-flex justify-content-between">
                            <strong>历史爱好者</strong>
                            <small>2023-12-14 15:45</small>
                        </div>
                        <p class="mb-1">网站内容很丰富，时间轴设计得很清晰...</p>
                        <small class="text-warning">状态：待审核</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 系统状态 -->
    <div class="col-lg-6 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">系统状态</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <div class="d-flex justify-content-between">
                        <span>服务器状态</span>
                        <span class="text-success">正常</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 100%"></div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="d-flex justify-content-between">
                        <span>数据库连接</span>
                        <span class="text-success">正常</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 100%"></div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="d-flex justify-content-between">
                        <span>文件存储</span>
                        <span class="text-success">正常</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 100%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
