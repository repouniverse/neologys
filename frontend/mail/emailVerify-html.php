<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
?>
<div class="password-reset">
    
    <p>Buenas tardes <?= Html::encode($user->username) ?>,</p>

    <p>Has registrado esta dirección de correo en la aplicación.</p>

   
</div>
