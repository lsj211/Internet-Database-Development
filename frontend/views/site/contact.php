<?php
/* 联系页面（简洁的 Yii2 视图模板） */
use yii\helpers\Html;
$this->title = '联系我们';
?>

<div class="site-contact container py-5">
	<h1><?= Html::encode($this->title) ?></h1>
	<p>如果您有问题或建议，请通过以下方式联系团队：</p>
	<ul>
		<li>邮箱：contact@example.com</li>
		<li>电话：010-12345678</li>
	</ul>
	<p>或者通过 <a href="<?= \yii\helpers\Url::to(['site/message']) ?>">留言板</a> 留言，我们会尽快回复。</p>
</div>
