<?php

/**
 * Team: 抗战纪念队, NKU
 * Coding by chengna 2311828
 * This file is used to display the login page.
 */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = '用户登录';
?>

<div class="site-login container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <h1 class="h4 text-gray-900">抗战纪念队 - 用户登录</h1>
                    </div>
                    
                    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                        <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder' => '用户名'])->label(false) ?>

                        <?= $form->field($model, 'password')->passwordInput(['placeholder' => '密码'])->label(false) ?>

                        <div class="row">
                            <div class="col-8">
                                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                                    'template' => '{input}{image}',
                                    'imageOptions' => ['alt' => '验证码', 'style' => 'cursor:pointer;height:34px;'],
                                    'options' => ['placeholder' => '验证码', 'class' => 'form-control']
                                ])->label(false) ?>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <?= $form->field($model, 'rememberMe')->checkbox([
                                        'template' => '<div class="form-check">{input} {label}</div>',
                                        'labelOptions' => ['class' => 'form-check-label'],
                                        'class' => 'form-check-input'
                                    ]) ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <?= Html::submitButton('登录', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
                        </div>

                    <?php ActiveForm::end(); ?>
                    
                    <hr>
                    <div class="text-center">
                        <a class="small" href="<?= Url::to(['site/request-password-reset']) ?>">忘记密码？</a>
                    </div>
                    <div class="text-center">
                        <a class="small" href="<?= Url::to(['site/signup']) ?>">还没有账号？立即注册</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
