<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AdminProfileForm */
/* @var $user common\models\User */

$this->title = '管理员信息';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-admin-profile">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-info">
        当前管理员：<?= Html::encode($user->username) ?>（ID: <?= Html::encode($user->id) ?>）
    </div>

    <?php $form = ActiveForm::begin(['id' => 'admin-profile-form']); ?>

    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
    <?= $form->field($model, 'email')->textInput() ?>

    <hr>
    <p class="text-muted">如需修改密码，请填写以下两项：</p>
    <?= $form->field($model, 'password')->passwordInput() ?>
    <?= $form->field($model, 'password_confirm')->passwordInput() ?>

    <div class="form-group">
        <?= Html::submitButton('保存修改', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
