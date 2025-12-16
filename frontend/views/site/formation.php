<?php
/** @var string $type */
use yii\helpers\Html;
use yii\helpers\Url;

$map = [
    'infantry' => '步兵方阵',
    'airforce' => '空军方阵',
    'navy' => '海军方阵',
    'equipment' => '装备展示',
];
$title = $map[$type] ?? '方阵展示';
$this->title = $title;
?>

<div class="container py-4">
    <h1><?= Html::encode($title) ?></h1>
    <p>这是「<?= Html::encode($title) ?>」的展示页面。请在此处对接或展示对应的内容（图片、视频、3D 模型等）。</p>
    <p>当前类型：<strong><?= Html::encode($type) ?></strong></p>
    <p>
        <a href="<?= Url::to(['site/parade']) ?>" class="btn btn-secondary">返回阅兵页面</a>
    </p>
</div>
