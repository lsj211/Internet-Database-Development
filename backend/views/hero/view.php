<?php

/**
 * Team: DBIS, NKU
 * Coding by chengna 2311828
 * This file is part of the backend views for hero view.
 */

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Hero */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '抗战英雄管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="hero-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '确定要删除这个英雄吗？',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'title',
            [
                'attribute' => 'image_url',
                'format' => 'html',
                'value' => Html::img(Yii::getAlias($model->image_url), ['style' => 'max-width:300px;'])
            ],
            'brief:ntext',
            'deeds:ntext',
            'contribution:ntext',
            'birth_year',
            'death_year',
            'sort_order',
            [
                'attribute' => 'status',
                'value' => $model->status == 1 ? '启用' : '禁用'
            ],
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>
