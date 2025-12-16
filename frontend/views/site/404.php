<?php

/* @var $this yii\web\View */
/* @var $exception \yii\web\HttpException */

use yii\helpers\Url;

$this->title = '404 - 页面未找到';
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- 404 Error Text -->
<div class="text-center">
    <div class="error mx-auto" data-text="404">404</div>
    <p class="lead text-gray-800 mb-5">页面未找到</p>
    <p class="text-gray-500 mb-0">看起来您访问的页面不存在...</p>
    <a href="<?= Url::to(['/site/index']) ?>">&larr; 返回首页</a>
</div>

<style>
.error {
    font-size: 7rem;
    position: relative;
    line-height: 1;
    width: 12.5rem;
}
</style>
