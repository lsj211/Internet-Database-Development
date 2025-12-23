<?php

/**
 * Team：抗战纪念队， NKU
 * Codeing by chengna 2311828
 * This file is used to create a signup form for new users.
 */

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Url;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to signup:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email')->textInput(['id' => 'signup-email']) ?>

                <?= $form->field($model, 'student_id')->textInput(['placeholder' => '请输入学号（可选）'])->label('学号') ?>

                <div class="form-group field-signupform-emailverifycode">
                    <label class="control-label" for="signupform-emailverifycode">邮箱验证码</label>
                    <div class="input-group">
                        <?= Html::activeTextInput($model, 'emailVerifyCode', ['class' => 'form-control', 'placeholder' => '请输入邮箱验证码']) ?>
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-info" id="send-email-code" onclick="sendEmailCode()">发送验证码</button>
                        </span>
                    </div>
                    <p class="help-block help-block-error"></p>
                </div>

                <?= $form->field($model, 'password')->passwordInput()->hint('密码至少8位，必须包含大写字母、小写字母和数字') ?>

                <?= $form->field($model, 'password_confirm')->passwordInput()->label('确认密码') ?>

                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-xs-6">{input}</div><div class="col-xs-6">{image}</div></div>',
                ])->label('验证码') ?>

                <div class="form-group">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<script>
var countdown = 0;

function sendEmailCode() {
    var email = $('#signup-email').val();
    var btn = $('#send-email-code');
    
    if (!email) {
        alert('请先输入邮箱地址');
        return;
    }
    
    if (countdown > 0) {
        return;
    }
    
    btn.prop('disabled', true);
    btn.text('发送中...');
    
    $.ajax({
        url: '<?= Url::to(['site/send-email-code']) ?>',
        type: 'POST',
        data: {
            email: email,
            '<?= Yii::$app->request->csrfParam ?>': '<?= Yii::$app->request->csrfToken ?>'
        },
        success: function(data) {
            if (data.success) {
                alert(data.message);
                countdown = 60;
                updateButton();
            } else {
                alert(data.message);
                btn.prop('disabled', false);
                btn.text('发送验证码');
            }
        },
        error: function() {
            alert('发送失败，请稍后重试');
            btn.prop('disabled', false);
            btn.text('发送验证码');
        }
    });
}

function updateButton() {
    var btn = $('#send-email-code');
    if (countdown > 0) {
        btn.text(countdown + '秒后重试');
        countdown--;
        setTimeout(updateButton, 1000);
    } else {
        btn.prop('disabled', false);
        btn.text('发送验证码');
    }
}
</script>
