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
    <?= $form->field($model, 'student_id')->textInput(['maxlength' => true]) ?>
    <div class="form-group">
        <label class="control-label">邮箱验证码</label>
        <div class="input-group">
            <span class="input-group-addon">验证码</span>
            <?= $form->field($model, 'emailVerifyCode')->textInput(['maxlength' => 6, 'class' => 'form-control'])->label(false) ?>
            <span class="input-group-btn">
                <button type="button" class="btn btn-default" id="send-email-code">发送验证码</button>
            </span>
        </div>
    </div>
    <?= $form->field($model, 'password')->passwordInput() ?>
    <?= $form->field($model, 'password_confirm')->passwordInput() ?>

    <div class="form-group">
        <?= Html::submitButton('创建管理员', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>
</div>

<?php
$sendUrl = \yii\helpers\Url::to(['site/send-email-code']);
$csrfParam = Yii::$app->request->csrfParam;
$csrfToken = Yii::$app->request->getCsrfToken();
$js = <<<JS
document.getElementById('send-email-code').addEventListener('click', function () {
    var emailInput = document.getElementById('adminsignupform-email');
    var email = emailInput ? emailInput.value : '';
    if (!email) {
        alert('请先填写邮箱');
        return;
    }
    fetch('{$sendUrl}', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: '{$csrfParam}=' + encodeURIComponent('{$csrfToken}') + '&email=' + encodeURIComponent(email)
    }).then(function (resp) { return resp.json(); })
      .then(function (data) { alert(data.message || '发送完成'); })
      .catch(function () { alert('发送失败'); });
});
JS;
$this->registerJs($js);
?>
