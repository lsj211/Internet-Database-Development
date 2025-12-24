<?php
/**
 * Team: 抗战纪念队, NKU
 * Coding by LiuYueshuai 2313752
 * This is the error view displayed when an error occurs.
 */
use yii\helpers\Html;
$this->title = $name;
?>
<div class="site-error">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>
    <p>
        访问页面时发生错误。
    </p>
</div>