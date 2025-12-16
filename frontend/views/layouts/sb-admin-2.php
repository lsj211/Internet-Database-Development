<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\assets\SbAdmin2Asset;

SbAdmin2Asset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style>
        /* 自定义抗战主题色调 */
        :root {
            --primary: #8B0000; /* 深红色，代表鲜血和牺牲 */
            --secondary: #FFD700; /* 金色，代表胜利和荣耀 */
            --success: #228B22; /* 深绿色，代表希望和新生命 */
            --info: #4169E1; /* 皇家蓝，代表忠诚和坚定 */
            --warning: #FF6347; /* 珊瑚红，代表热情和战斗 */
            --danger: #DC143C; /* 猩红，代表牺牲 */
            --light: #FFF8DC; /* 玉米丝色，柔和的背景 */
            --dark: #2F4F4F; /* 深灰石板色，庄重 */
        }

        .bg-gradient-primary {
            background: linear-gradient(135deg, var(--primary) 0%, #B22222 100%) !important;
        }

        .text-primary {
            color: var(--primary) !important;
        }

        .border-left-primary {
            border-left: 4px solid var(--primary) !important;
        }

        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .btn-primary:hover {
            background-color: #A52A2A;
            border-color: #A52A2A;
        }
    </style>
</head>
<body id="page-top">
<?php $this->beginBody() ?>

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= Url::to(['/site/index']) ?>">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-flag"></i>
            </div>
            <div class="sidebar-brand-text mx-3">抗战纪念队</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - 首页 -->
        <li class="nav-item <?= $this->context->route == 'site/index' ? 'active' : '' ?>">
            <a class="nav-link" href="<?= Url::to(['/site/index']) ?>">
                <i class="fas fa-fw fa-home"></i>
                <span>首页</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            团队展示
        </div>

        <!-- Nav Item - 团队介绍 -->
        <li class="nav-item <?= $this->context->route == 'site/team' ? 'active' : '' ?>">
            <a class="nav-link" href="<?= Url::to(['/site/team']) ?>">
                <i class="fas fa-fw fa-users"></i>
                <span>团队介绍</span></a>
        </li>

        <!-- Nav Item - 抗战历史 -->
        <li class="nav-item <?= $this->context->route == 'site/history' ? 'active' : '' ?>">
            <a class="nav-link" href="<?= Url::to(['/site/history']) ?>">
                <i class="fas fa-fw fa-history"></i>
                <span>抗战历史</span></a>
        </li>

        <!-- Nav Item - 留言板 -->
        <li class="nav-item <?= $this->context->route == 'message/index' ? 'active' : '' ?>">
            <a class="nav-link" href="<?= Url::to(['/message/index']) ?>">
                <i class="fas fa-fw fa-comments"></i>
                <span>留言板</span></a>
        </li>

        <!-- Nav Item - 作业下载 -->
        <li class="nav-item <?= $this->context->route == 'site/download' ? 'active' : '' ?>">
            <a class="nav-link" href="<?= Url::to(['/site/download']) ?>">
                <i class="fas fa-fw fa-download"></i>
                <span>作业下载</span></a>
        </li>

        <!-- Nav Item - 烈士纪念 -->
        <li class="nav-item <?= $this->context->route == 'site/memorial' ? 'active' : '' ?>">
            <a class="nav-link" href="<?= Url::to(['/site/memorial']) ?>">
                <i class="fas fa-fw fa-monument"></i>
                <span>烈士纪念</span></a>
        </li>

        <!-- Nav Item - 阅兵仪式 -->
        <li class="nav-item <?= $this->context->route == 'site/parade' ? 'active' : '' ?>">
            <a class="nav-link" href="<?= Url::to(['/site/parade']) ?>">
                <i class="fas fa-fw fa-flag"></i>
                <span>阅兵仪式</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

        <!-- Sidebar Message -->
        <div class="sidebar-card d-none d-lg-flex">
            <img class="sidebar-card-illustration mb-2" src="<?= Url::to('@web/img/undraw_rocket.svg') ?>" alt="...">
            <p class="text-center mb-2"><strong>后台管理</strong> 团队成员登录入口</p>
            <a class="btn btn-success btn-sm" href="<?= Url::to(['/site/login']) ?>">进入后台</a>
        </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - 后台登录 -->
                    <li class="nav-item">
                        <a class="nav-link" href="<?= Url::to(['/site/login']) ?>">
                            <i class="fas fa-sign-in-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            后台登录
                        </a>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">
                <?= $content ?>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; 抗战纪念队 <?= date('Y') ?></span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">确定要退出登录吗？</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">选择"退出登录"将结束您的当前会话。</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">取消</button>
                <?php if (!Yii::$app->user->isGuest): ?>
                    <a class="btn btn-primary" href="<?= Url::to(['/site/logout']) ?>" data-method="post">退出登录</a>
                <?php else: ?>
                    <a class="btn btn-primary" href="<?= Url::to(['/site/login']) ?>">登录</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

