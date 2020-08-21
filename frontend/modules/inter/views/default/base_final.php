<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use frontend\modules\inter\helpers\ComboHelper;
?>

<div class="login-box">    
    <!-- /.login-logo -->
    <div class="login-box-body">
        <div class="alert alert-warning">
                       <?=\yii::t('base_labels','Congratulations, You have completed the authentication process successfully,Your user account is "{codigo}", Now you need to reset your password, We have sent a message again to request it, please check it ',['codigo'=>Html::encode($model->codigo),'correo'=>Html::encode($model->email)]) ?>
@
        </div>

     
        
    </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->

