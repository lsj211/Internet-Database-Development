<?php

use yii\helpers\Html;
use yii\helpers\Url;
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

    <?php
    $frontendBaseUrl = preg_replace('#/backend/web$#', '/frontend/web', Yii::$app->request->baseUrl);
    if ($frontendBaseUrl === Yii::$app->request->baseUrl) {
        $frontendBaseUrl = '/frontend/web';
    }
    $avatarUrl = !empty($user->avatar)
        ? (strpos($user->avatar, 'http') === 0 ? $user->avatar : $frontendBaseUrl . $user->avatar)
        : Url::to('@web/img/undraw_profile.svg');
    ?>

    <?php $form = ActiveForm::begin([
        'id' => 'admin-profile-form',
        'options' => ['enctype' => 'multipart/form-data'],
    ]); ?>

    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
    <?= $form->field($model, 'email')->textInput() ?>
    <?= $form->field($model, 'student_id')->textInput() ?>
    <?= $form->field($model, 'major')->textInput() ?>
    <?= $form->field($model, 'role')->textInput() ?>
    <?= $form->field($model, 'signature')->textInput() ?>
    <?= $form->field($model, 'bio')->textarea(['rows' => 4]) ?>
    <?= $form->field($model, 'age')->textInput() ?>

    <div class="form-group">
        <label>当前头像</label>
        <div>
            <img src="<?= Html::encode($avatarUrl) ?>" alt="头像" style="width: 120px; height: 120px; object-fit: cover; border-radius: 50%;">
        </div>
    </div>
    <?= $form->field($model, 'avatarFile')->fileInput() ?>

    <hr>
    <p class="text-muted">如需修改密码，请填写以下两项：</p>
    <?= $form->field($model, 'password')->passwordInput() ?>
    <?= $form->field($model, 'password_confirm')->passwordInput() ?>

    <div class="form-group">
        <?= Html::submitButton('保存修改', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
