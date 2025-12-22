<?php

/**
 * Team: DBIS, NKU
 * Coding by chengna 2311828
 * This file is part of the backend views for historical material view.
 */

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\HistoricalMaterial */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => '抗战史料管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="historical-material-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '确定要删除这个史料吗？',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'category',
            [
                'attribute' => 'image_url',
                'format' => 'html',
                'value' => Html::img(Yii::getAlias($model->image_url), ['style' => 'max-width:300px;'])
            ],
            'summary:ntext',
            'content:ntext',
            'event_date',
            'source',
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
