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
</head>
<body id="page-top">
<?php $this->beginBody() ?>

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= Url::to(['/site/admin']) ?>">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-cogs"></i>
            </div>
            <div class="sidebar-brand-text mx-3">后台管理</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - 仪表板 -->
        <li class="nav-item <?= $this->context->route == 'site/admin' ? 'active' : '' ?>">
            <a class="nav-link" href="<?= Url::to(['/site/admin']) ?>">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>仪表板</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            信息管理
        </div>

        <!-- Nav Item - 团队信息编辑 -->
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="fas fa-fw fa-users"></i>
                <span>团队信息</span></a>
        </li>

        <!-- Nav Item - 抗战历史管理 -->
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="fas fa-fw fa-history"></i>
                <span>抗战历史</span></a>
        </li>

        <!-- Nav Item - 留言管理 -->
        <li class="nav-item">
            <a class="nav-link" href="<?= Url::to(['/message/index']) ?>">
                <i class="fas fa-fw fa-comments"></i>
                <span>留言管理</span></a>
        </li>

        <!-- Nav Item - 作业管理 -->
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="fas fa-fw fa-upload"></i>
                <span>作业管理</span></a>
        </li>

        <!-- Nav Item - 公告发布 -->
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="fas fa-fw fa-bullhorn"></i>
                <span>公告发布</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            数据管理
        </div>

        <!-- Nav Item - 数据统计 -->
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="fas fa-fw fa-chart-bar"></i>
                <span>数据统计</span></a>
        </li>

        <!-- Nav Item - 数据库查看 -->
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="fas fa-fw fa-database"></i>
                <span>数据库查看</span></a>
        </li>

        <!-- Nav Item - 系统设置 -->
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="fas fa-fw fa-cog"></i>
                <span>系统设置</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
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

                    <!-- Nav Item - 公告 -->
                    <li class="nav-item dropdown no-arrow mx-1">
                        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-bell fa-fw"></i>
                            <!-- Counter - Alerts -->
                            <span class="badge badge-danger badge-counter">3+</span>
                        </a>
                        <!-- Dropdown - Alerts -->
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                            aria-labelledby="alertsDropdown">
                            <h6 class="dropdown-header">
                                系统通知
                            </h6>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="mr-3">
                                    <div class="icon-circle bg-primary">
                                        <i class="fas fa-file-alt text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">2023-12-15</div>
                                    <span class="font-weight-bold">有新的留言待审核</span>
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="mr-3">
                                    <div class="icon-circle bg-success">
                                        <i class="fas fa-upload text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">2023-12-14</div>
                                    <span class="font-weight-bold">作业文件已更新</span>
                                </div>
                            </a>
                        </div>
                    </li>

                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">管理员</span>
                            <img class="img-profile rounded-circle"
                                src="<?= Url::to('@web/img/undraw_profile.svg') ?>">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                            aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                个人资料
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                设置
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                退出登录
                            </a>
                        </div>
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

