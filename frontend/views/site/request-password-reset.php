<?php

/**
 * Team: DBIS, NKU
 * Coding by chengna 2311828
 * This file is used to request password reset.
 */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = '重置密码';
?>

<div class="site-request-password-reset container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <h1 class="h4 text-gray-900">忘记密码？</h1>
                        <p class="text-gray-600">请输入您的邮箱地址，我们将发送密码重置链接。</p>
                    </div>

                    <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

                        <?= $form->field($model, 'email')->textInput([
                            'autofocus' => true,
                            'placeholder' => '请输入您的邮箱地址'
                        ])->label(false) ?>

                        <div class="form-group">
                            <?= Html::submitButton('发送重置链接', ['class' => 'btn btn-primary btn-block']) ?>
                        </div>

                    <?php ActiveForm::end(); ?>

                    <hr>
                    <div class="text-center">
                        <a class="small" href="<?= \yii\helpers\Url::to(['site/login']) ?>">返回登录</a>
                    </div>
                    <div class="text-center">
                        <a class="small" href="<?= \yii\helpers\Url::to(['site/signup']) ?>">还没有账号？立即注册</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
