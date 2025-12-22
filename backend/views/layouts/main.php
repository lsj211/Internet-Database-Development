<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    $frontendBaseUrl = preg_replace('#/backend/web$#', '/frontend/web', Yii::$app->request->baseUrl);
    if ($frontendBaseUrl === Yii::$app->request->baseUrl) {
        $frontendBaseUrl = '/frontend/web';
    }
    $frontendHomeUrl = $frontendBaseUrl . '/index.php';
    NavBar::begin([
        'brandLabel' => '抗战纪念队后台',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => '登录', 'url' => ['/site/login']];
        $menuItems[] = ['label' => '返回前台', 'url' => $frontendHomeUrl];
    } else {
        $menuItems[] = ['label' => '管理员信息', 'url' => ['/site/profile']];
        $menuItems[] = ['label' => '英雄管理', 'url' => ['/hero/index']];
        $menuItems[] = ['label' => '史料管理', 'url' => ['/historical-material/index']];
        $menuItems[] = ['label' => '注册管理员', 'url' => ['/site/register-admin']];
        $menuItems[] = ['label' => '返回前台', 'url' => $frontendHomeUrl];
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                '退出 (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
