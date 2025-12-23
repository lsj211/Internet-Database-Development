<?php

/**
 * Team: 抗战纪念队, NKU
 * Coding by chengna 2311828
 * This file is used to reset password.
 */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = '重置密码';
?>

<div class="site-reset-password container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <h1 class="h4 text-gray-900">重置您的密码</h1>
                        <p class="text-gray-600">请输入新密码</p>
                    </div>

                    <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>

                        <?= $form->field($model, 'password')->passwordInput([
                            'autofocus' => true,
                            'placeholder' => '请输入新密码'
                        ])->label('新密码') ?>

                        <div class="form-group">
                            <?= Html::submitButton('保存', ['class' => 'btn btn-primary btn-block']) ?>
                        </div>

                    <?php ActiveForm::end(); ?>

                    <hr>
                    <div class="text-center">
                        <a class="small" href="<?= \yii\helpers\Url::to(['site/login']) ?>">返回登录</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
