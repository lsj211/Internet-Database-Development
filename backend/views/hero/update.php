<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Hero */

$this->title = '更新英雄: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '抗战英雄管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="hero-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
