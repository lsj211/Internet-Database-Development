<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$this->title = '管理员信息';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-lg-4 mb-4">
        <div class="card shadow h-100">
            <div class="card-body text-center">
                <?php
                $avatarUrl = !empty($user->avatar)
                    ? (strpos($user->avatar, 'http') === 0 ? $user->avatar : Url::to('@web' . $user->avatar))
                    : Url::to('@web/img/undraw_profile.svg');
                ?>
                <img class="rounded-circle mb-3" src="<?= Html::encode($avatarUrl) ?>" alt="头像" style="width: 160px; height: 160px; object-fit: cover;">
                <h4 class="card-title mb-1"><?= Html::encode($user->username) ?></h4>
                <?php if (!empty($user->student_id)): ?>
                    <p class="text-muted mb-2"><?= Html::encode($user->student_id) ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="col-lg-8 mb-4">
        <div class="card shadow h-100">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">管理员信息</h6>
            </div>
            <div class="card-body">
                <p><strong>用户名：</strong><?= Html::encode($user->username) ?></p>
                <p><strong>邮箱：</strong><?= Html::encode($user->email) ?></p>
                <?php if (!empty($user->major)): ?>
                    <p><strong>专业：</strong><?= Html::encode($user->major) ?></p>
                <?php endif; ?>
                <?php if (!empty($user->role)): ?>
                    <p><strong>团队分工：</strong><?= Html::encode($user->role) ?></p>
                <?php endif; ?>
                <?php if (!empty($user->signature)): ?>
                    <p><strong>个性签名：</strong><?= Html::encode($user->signature) ?></p>
                <?php endif; ?>
                <?php if (!empty($user->bio)): ?>
                    <p><strong>个人简介：</strong><?= Html::encode($user->bio) ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
