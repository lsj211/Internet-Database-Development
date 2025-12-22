<?php

/**
 * Team: DBIS, NKU
 * Coding by chengna 2311828
 * This file is used to edit user profile.
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Member */

$this->title = '编辑个人资料';
?>

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= Html::encode($this->title) ?></h1>
    </div>

    <?php if (Yii::$app->session->hasFlash('profile_success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>成功！</strong> <?= Yii::$app->session->getFlash('profile_success') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <?php if (Yii::$app->session->hasFlash('profile_error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>错误！</strong> <?= Yii::$app->session->getFlash('profile_error') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">个人信息</h6>
                </div>
                <div class="card-body">
                    <?php $form = ActiveForm::begin([
                        'options' => ['enctype' => 'multipart/form-data'],
                        'enableClientValidation' => false,
                        'enableAjaxValidation' => false,
                    ]); ?>

                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'readonly' => true]) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'student_id')->textInput(['maxlength' => true, 'placeholder' => '请输入学号']) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'major')->textInput(['maxlength' => true, 'placeholder' => '请输入专业']) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'role')->textInput(['maxlength' => true, 'placeholder' => '例如：前端开发、后端工程师']) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'age')->textInput(['type' => 'number', 'placeholder' => '请输入年龄']) ?>
                        </div>
                    </div>

                    <?= $form->field($model, 'signature')->textInput(['maxlength' => true, 'placeholder' => '写下你的个性签名...']) ?>

                    <?= $form->field($model, 'homework_link')->textInput(['maxlength' => true, 'placeholder' => '例如：https://github.com/username/repo']) ?>

                    <?= $form->field($model, 'bio')->textarea(['rows' => 6, 'placeholder' => '介绍一下自己...']) ?>

                    <div class="form-group">
                        <label>头像</label>
                        <div class="mb-3">
                            <?php if ($model->avatar): ?>
                                <?php 
                                $avatarUrl = strpos($model->avatar, 'http') === 0 ? $model->avatar : \yii\helpers\Url::to('@web' . $model->avatar);
                                ?>
                                <img src="<?= $avatarUrl ?>" class="img-thumbnail" style="max-width: 150px; max-height: 150px;" alt="当前头像">
                            <?php else: ?>
                                <img src="<?= \yii\helpers\Url::to('@web/img/undraw_profile.svg') ?>" class="img-thumbnail" style="max-width: 150px; max-height: 150px;" alt="默认头像">
                            <?php endif; ?>
                        </div>
                        <?= $form->field($model, 'avatar')->fileInput(['accept' => 'image/*'])->label('上传新头像（可选）') ?>
                        <small class="form-text text-muted">支持 JPG、PNG、GIF 格式，建议尺寸 300x300 像素</small>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> 保存修改
                        </button>
                        <a href="<?= \yii\helpers\Url::to(['/site/profile', 'id' => $model->id]) ?>" class="btn btn-secondary">
                            <i class="fas fa-times"></i> 取消
                        </a>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">提示</h6>
                </div>
                <div class="card-body">
                    <ul class="pl-3">
                        <li class="mb-2">邮箱地址无法修改</li>
                        <li class="mb-2">学号和专业将显示在团队介绍页面</li>
                        <li class="mb-2">个性签名会在个人主页显著展示</li>
                        <li class="mb-2">作业链接可以是 GitHub 或其他代码托管平台</li>
                        <li class="mb-2">头像建议使用正方形图片，系统会自动裁剪为圆形</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
