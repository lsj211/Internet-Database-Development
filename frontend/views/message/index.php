<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;
use yii\helpers\Url;

/** @var $this yii\web\View */
/** @var $dataProvider yii\data\ActiveDataProvider */
/** @var $model common\models\Message */

$this->title = '缅怀历史，致敬先烈';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="message-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php foreach (Yii::$app->session->getAllFlashes() as $type => $message): ?>
        <div class="alert alert-<?= $type ?>"><?= Html::encode($message) ?></div>
    <?php endforeach; ?>

    <div class="row">
        <div class="col-md-6">
            <h3>你长眠，我常念</h3>
            <?= ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => function($model){
                    /** @var common\models\Message $model */
                    $username = $model->user ? Html::encode($model->user->username) : '匿名';
                    $time = Yii::$app->formatter->asDatetime($model->created_at);
                    return '<div class="panel panel-default">'
                        . '<div class="panel-heading"><strong>' . $username . '</strong> <span class="text-muted" style="font-size:12px">' . $time . '</span></div>'
                        . '<div class="panel-body">' . nl2br(Html::encode($model->content)) . '</div>'
                        . '</div>';
                },
                'summary' => '',
                'emptyText' => '',
                'pager' => [
                    'firstPageLabel' => '首页',
                    'lastPageLabel' => '末页',
                ]
            ]); ?>
        </div>
        <div class="col-md-6">
            <h3>发表留言</h3>
            <?php if (Yii::$app->user->isGuest): ?>
                <p>
                    请先 <?= Html::a('登录', Url::to(['site/login'])) ?> 或 <?= Html::a('注册', Url::to(['site/signup'])) ?> 后再留言。
                </p>
            <?php else: ?>
                <?php $form = ActiveForm::begin(['action' => ['message/create'], 'options' => ['class' => 'form-vertical']]); ?>
                    <?= $form->field($model, 'content')->textarea(['rows' => 5, 'maxlength' => 5000])->label('内容') ?>
                    <div class="form-group">
                        <?= Html::submitButton('发布', ['class' => 'btn btn-primary']) ?>
                    </div>
                <?php ActiveForm::end(); ?>
            <?php endif; ?>
        </div>
    </div>
</div>
