<?php

/**
 * Team: 抗战纪念队, NKU
 * Coding by chengna 2311828
 * This file is part of the backend views for hero creation.
 */

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Hero */

$this->title = '创建英雄';
$this->params['breadcrumbs'][] = ['label' => '抗战英雄管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hero-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
