<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use frontend\modules\inter\helpers\ComboHelper;
use frontend\modules\inter\Module as m;
?>

<div class="login-box">    
    <!-- /.login-logo -->
    <div class="login-box-body">
        <div class="alert alert-info">
            
           <?=\m::t('validaciones','Dear {codigo} , You have completed the authentication first step, now you just need to open your email {correo}. We have sent a message to verify your account, please check it',['codigo'=>Html::encode($code),'correo'=>Html::encode($correo)]) ?>
        </div>

     
        
    </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->

