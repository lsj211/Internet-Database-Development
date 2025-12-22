<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Hero */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hero-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

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

    <?= $form->field($model, 'brief')->textarea(['rows' => 3]) ?>

    <?= $form->field($model, 'deeds')->textarea(['rows' => 4]) ?>

    <?= $form->field($model, 'contribution')->textarea(['rows' => 4]) ?>

    <?= $form->field($model, 'birth_year')->textInput() ?>

    <?= $form->field($model, 'death_year')->textInput() ?>

    <?= $form->field($model, 'sort_order')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList([1 => '启用', 0 => '禁用']) ?>

    <div class="form-group">
        <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
