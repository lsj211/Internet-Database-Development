<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Hero */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hero-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image_url')->textInput(['maxlength' => true, 'placeholder' => '例如：@web/img/hero1.jpg']) ?>

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
