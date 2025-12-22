<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AdminSignupForm */

$this->title = '注册管理员';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-register-admin">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>请填写管理员账号信息：</p>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
    <?= $form->field($model, 'email')->textInput() ?>
    <?= $form->field($model, 'password')->passwordInput() ?>
    <?= $form->field($model, 'password_confirm')->passwordInput() ?>

    <div class="form-group">
        <?= Html::submitButton('创建管理员', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
