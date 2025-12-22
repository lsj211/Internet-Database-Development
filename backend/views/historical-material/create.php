<?php

/**
 * Team: DBIS, NKU
 * Coding by chengna 2311828
 * This file is part of the backend views for historical material creation.
 */
    
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\HistoricalMaterial */

$this->title = '创建史料';
$this->params['breadcrumbs'][] = ['label' => '抗战史料管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="historical-material-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
