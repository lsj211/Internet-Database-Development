<?php

/**
 * Team: 抗战纪念队, NKU
 * Coding by chengna 2311828
 * This file is part of the password reset email template.
 */

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
?>
Hello <?= $user->username ?>,

Follow the link below to reset your password:

<?= $resetLink ?>
