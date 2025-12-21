<?php

/* @var $this yii\web\View */
/* @var $model common\models\Hero */

use yii\helpers\Url;
use yii\helpers\Html;

$this->title = $model->name . ' 详情';
$this->params['breadcrumbs'][] = ['label' => '抗战历史', 'url' => ['/site/history']];
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
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
</style>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= Html::encode($model->name) ?> 详情</h1>
    <a href="<?= Url::to(['/site/history', '#' => 'heroes-section']) ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> 返回抗战英雄列表
    </a>
</div>

<div class="row">
    <div class="col-lg-4 mb-4">
        <div class="card shadow mb-4">
            <div class="card-body text-center">
                <img src="<?= Url::to($model->image_url ?: '@web/img/undraw_profile.svg') ?>" 
                     alt="<?= Html::encode($model->name) ?>" 
                     class="img-fluid rounded mb-3" 
                     style="max-height: 260px; object-fit: cover;"
                     onerror="this.src='<?= Url::to('@web/img/undraw_profile.svg') ?>'">
                <h4 class="mb-2"><?= Html::encode($model->name) ?></h4>
                <?php if ($model->title): ?>
                    <p class="text-muted mb-2"><?= Html::encode($model->title) ?></p>
                <?php endif; ?>
                <?php if ($model->birth_year || $model->death_year): ?>
                    <p class="text-muted small mb-0">
                        <?= $model->birth_year ?: '?' ?> 年 - <?= $model->death_year ?: '?' ?> 年
                    </p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="col-lg-8 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">英雄事迹</h6>
            </div>
            <div class="card-body">
                <?php if ($model->brief): ?>
                    <h5>人物简介</h5>
                    <p><?= nl2br(Html::encode($model->brief)) ?></p>
                <?php endif; ?>

                <?php if ($model->deeds): ?>
                    <h5 class="mt-3">主要事迹</h5>
                    <p><?= nl2br(Html::encode($model->deeds)) ?></p>
                <?php endif; ?>

                <?php if ($model->contribution): ?>
                    <h5 class="mt-3">历史贡献</h5>
                    <p><?= nl2br(Html::encode($model->contribution)) ?></p>
                <?php endif; ?>

                <?php if (!$model->brief && !$model->deeds && !$model->contribution): ?>
                    <p class="text-muted">该英雄的详细事迹信息暂未完善。</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
