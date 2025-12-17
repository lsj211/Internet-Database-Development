<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\HistoricalMaterial */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="historical-material-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'category')->textInput(['maxlength' => true, 'placeholder' => '例如：战役、宣言、文献']) ?>

    <?= $form->field($model, 'image_url')->textInput(['maxlength' => true, 'placeholder' => '例如：@web/img/document1.jpg']) ?>

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
