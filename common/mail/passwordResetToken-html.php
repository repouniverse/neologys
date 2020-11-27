<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
?>
<div class="password-reset">
    <p><?=yii::t('base_labels','Hello')?> <?= Html::encode($user->username) ?>,</p>

    <p><?=yii::t('base_labels','Follow the link below to reset your password:')?></p>

    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>
</div>
