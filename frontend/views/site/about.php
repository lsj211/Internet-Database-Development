<?php
/* 关于页面（简洁的 Yii2 视图模板） */
use yii\helpers\Html;
$this->title = '关于我们';
?>

<div class="site-about container py-5">
	<h1><?= Html::encode($this->title) ?></h1>
	<p>抗战纪念队致力于通过现代信息技术手段，传承和宣传抗日战争历史与先烈事迹。本页面为关于信息占位，请根据需要替换为完整内容。</p>
	<p>如需详细团队和项目介绍，请参见 <a href="<?= \yii\helpers\Url::to(['site/team']) ?>">团队介绍</a> 页面。</p>
</div>
