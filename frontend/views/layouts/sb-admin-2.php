<?php

/**
 * Team: 抗战纪念队, NKU
 * Coding by chengna 2311828
 * This file is part of the frontend layouts for admin panel.
 */

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\assets\SbAdmin2Asset;

SbAdmin2Asset::register($this);
$baseUrl = Yii::$app->request->baseUrl;
$backendBaseUrl = preg_replace('#/frontend/web$#', '/backend/web', $baseUrl);
if ($backendBaseUrl === $baseUrl) {
    $backendBaseUrl = '/backend/web';
}
$backendLoginUrl = $backendBaseUrl . '/index.php?r=site/login';
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
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            个人中心
        </div>

        <!-- Nav Item - 个人主页 -->
        <?php if (!Yii::$app->user->isGuest): ?>
        <li class="nav-item <?= $this->context->route == 'site/profile' && isset(Yii::$app->request->get()['id']) && Yii::$app->request->get('id') == Yii::$app->user->id ? 'active' : '' ?>">
            <a class="nav-link" href="<?= Url::to(['/site/profile', 'id' => Yii::$app->user->id]) ?>">
                <i class="fas fa-fw fa-user"></i>
                <span>我的主页</span></a>
        </li>
        <?php endif; ?>

        <!-- Nav Item - 管理员成员 -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAdmins"
                aria-expanded="true" aria-controls="collapseAdmins">
                <i class="fas fa-fw fa-user-shield"></i>
                <span>管理员</span>
            </a>
            <div id="collapseAdmins" class="collapse" aria-labelledby="headingAdmins" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">访问管理员主页:</h6>
                    <?php 
                    use common\models\User;
                    use common\models\Member;
                    // 优先显示有学号的管理员用户
                    $adminMembers = User::find()
                        ->where(['in', 'status', [User::STATUS_ACTIVE, User::STATUS_INACTIVE]])
                        ->andWhere(['not', ['student_id' => null]])
                        ->andWhere(['<>', 'student_id', ''])
                        ->orderBy(['created_at' => SORT_DESC])
                        ->limit(20)
                        ->all();
                    
                    foreach ($adminMembers as $admin): 
                    ?>
                        <a class="collapse-item" href="<?= Url::to(['/site/admin-profile', 'id' => $admin->id]) ?>">
                            <i class="fas fa-user-shield"></i> <?= \yii\helpers\Html::encode($admin->username) ?>
                            <?php if ($admin->student_id): ?>
                                <small class="text-muted">(<?= \yii\helpers\Html::encode($admin->student_id) ?>)</small>
                            <?php endif; ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </li>

        <!-- Nav Item - 普通用户成员 -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMembers"
                aria-expanded="true" aria-controls="collapseMembers">
                <i class="fas fa-fw fa-users"></i>
                <span>普通用户</span>
            </a>
            <div id="collapseMembers" class="collapse" aria-labelledby="headingMembers" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">访问用户主页:</h6>
                    <?php 
                    // 显示普通用户成员（Member表）
                    $regularMembers = Member::find()
                        ->where(['status' => Member::STATUS_ACTIVE])
                        ->orderBy(['created_at' => SORT_DESC])
                        ->limit(20)
                        ->all();
                    
                    if (empty($regularMembers)): ?>
                        <span class="collapse-item text-muted" style="cursor: default;">
                            <i class="fas fa-info-circle"></i> 暂无注册用户
                        </span>
                    <?php else: ?>
                        <?php foreach ($regularMembers as $member): ?>
                            <a class="collapse-item" href="<?= Url::to(['/site/profile', 'id' => $member->id]) ?>">
                                <i class="fas fa-user-circle"></i> <?= \yii\helpers\Html::encode($member->username) ?>
                                <?php if ($member->student_id): ?>
                                    <small class="text-muted">(<?= \yii\helpers\Html::encode($member->student_id) ?>)</small>
                                <?php endif; ?>
                            </a>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
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

                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - 用户信息 -->
                    <?php if (Yii::$app->user->isGuest): ?>
                        <!-- 未登录状态 -->
                        <li class="nav-item">
                            <a class="nav-link" href="<?= Html::encode($backendLoginUrl) ?>">
                                <i class="fas fa-user-shield fa-sm fa-fw mr-2 text-gray-400"></i>
                                <span class="d-none d-lg-inline text-gray-600">后台登录</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= Url::to(['/site/login']) ?>">
                                <i class="fas fa-sign-in-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                <span class="d-none d-lg-inline text-gray-600">登录</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= Url::to(['/site/signup']) ?>">
                                <i class="fas fa-user-plus fa-sm fa-fw mr-2 text-gray-400"></i>
                                <span class="d-none d-lg-inline text-gray-600">注册</span>
                            </a>
                        </li>
                    <?php else: ?>
                        <!-- 已登录状态 -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    <?= Html::encode(Yii::$app->user->identity->username) ?>
                                </span>
                                <?php 
                                $currentUser = Yii::$app->user->identity;
                                $avatarUrl = $currentUser->avatar 
                                    ? (strpos($currentUser->avatar, 'http') === 0 ? $currentUser->avatar : Url::to('@web' . $currentUser->avatar)) 
                                    : Url::to('@web/img/undraw_profile.svg');
                                ?>
                                <img src="<?= $avatarUrl ?>" class="rounded-circle" style="width: 32px; height: 32px; object-fit: cover;" alt="头像">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="<?= Url::to(['/site/profile', 'id' => Yii::$app->user->id]) ?>">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    个人主页
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    退出登录
                                </a>
                            </div>
                        </li>
                    <?php endif; ?>

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
                    <span class="ml-3 text-muted">
                        <i class="fas fa-eye"></i> 总访问量: 
                        <strong><?= \common\models\PageVisit::getTotalVisits() ?></strong> 次
                    </span>
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

<script>
// 确保用户下拉菜单正常工作
$(document).ready(function() {
    // 初始化所有dropdown
    $('.dropdown-toggle').dropdown();
    
    // 手动处理用户头像点击事件
    $('#userDropdown').click(function(e) {
        e.preventDefault();
        e.stopPropagation();
        $(this).next('.dropdown-menu').toggle();
    });
    
    // 点击其他地方关闭dropdown
    $(document).click(function(e) {
        if (!$(e.target).closest('.dropdown').length) {
            $('.dropdown-menu').hide();
        }
    });
});
</script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

