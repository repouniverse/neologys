<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use frontend\modules\inter\helpers\ComboHelper;
?>

<div class="login-box">    
    <!-- /.login-logo -->
    <div class="login-box-body">
        <div class="alert alert-info">
            
           <?=\yii::t('base_labels','Congratulations {codigo} , You have completed the authentication process successfully, you just need to confirm that the email {correo} works. We have sent a message to this email address, please check it ',['codigo'=>Html::encode($code),'correo'=>Html::encode($correo)]) ?>
        </div>

     
        
    </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->

