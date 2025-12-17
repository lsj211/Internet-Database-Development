<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '抗战史料管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="historical-material-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('创建史料', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'category',
            [
                'attribute' => 'image_url',
                'format' => 'html',
                'value' => function($model) {
                    return Html::img(Yii::getAlias($model->image_url), ['style' => 'width:80px;']);
                }
            ],
            'event_date',
            [
                'attribute' => 'status',
                'value' => function($model) {
                    return $model->status == 1 ? '启用' : '禁用';
                }
            ],
            'sort_order',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
