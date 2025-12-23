<?php

/**
 * Team: 抗战纪念队, NKU
 * Coding by chengna 2311828
 * This file is part of the backend views for historical material form.
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\HistoricalMaterial */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="historical-material-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'category')->textInput(['maxlength' => true, 'placeholder' => '例如：战役、宣言、文献']) ?>

    <?= $form->field($model, 'imageFile')->fileInput() ?>

    <?php if (!empty($model->image_url)): ?>
        <?php
        $frontendBaseUrl = preg_replace('#/backend/web$#', '/frontend/web', Yii::$app->request->baseUrl);
        $previewUrl = $model->image_url;
        if (strncmp($previewUrl, '@web/', 5) === 0) {
            $previewUrl = $frontendBaseUrl . substr($previewUrl, 4);
        } elseif (strncmp($previewUrl, '/uploads/', 9) === 0) {
            $previewUrl = $frontendBaseUrl . $previewUrl;
        }
        ?>
        <div class="form-group">
            <label>当前图片</label>
            <div>
                <img src="<?= Html::encode($previewUrl) ?>" alt="当前图片" style="max-width: 200px;">
            </div>
        </div>
    <?php endif; ?>

    <?= $form->field($model, 'image_url')->textInput(['maxlength' => true, 'placeholder' => '可选：手动填写图片URL']) ?>

    <?= $form->field($model, 'summary')->textarea(['rows' => 3]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'event_date')->textInput(['type' => 'date']) ?>

    <?= $form->field($model, 'source')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sort_order')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList([1 => '启用', 0 => '禁用']) ?>

    <div class="form-group">
        <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
