<?php

/**
 * Team: 抗战纪念队, NKU
 * Coding by chengna 2311828
 * This file is part of the backend views for historical material update.
 */

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\HistoricalMaterial */

$this->title = '更新史料: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => '抗战史料管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="historical-material-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
