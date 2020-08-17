<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use frontend\modules\inter\helpers\ComboHelper;
?>

<div class="login-box">    
    <!-- /.login-logo -->
    <div class="login-box-body">
        <div class="alert alert-danger">
            
           <?=\yii::t('base_labels','
The supplied token is not correct or it has been a long time and has expired, please re-authenticate')?>
        </div>

     
        
    </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->

